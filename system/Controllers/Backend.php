<?php
namespace system\Controllers;

use \system\Core;

defined("SITE_URI") OR die(header("Location: error/403"));

class Backend extends Core{
    
	public static $permissions = 'admin';

	public static $defaultMethod = 'ControlPanel';
	
    function __construct(){
		$this->HtmlView(array("Backend", "index"));
    }
    
    public function ControlPanel(){
     
    }

    public function AddArticle($article_id = ''){
		
        if(empty($article_id))
			$article_id = $this->RequestID;
		
		switch($this->userInput['type']){
			case "C": //new article
				$article_id = (isset($this->userInput['data']['id']) ? $this->userInput['data']['id'] : '');
				
				if(isset($_FILES['file']) && !empty($_FILES['file']['tmp_name'])){
					$newfolder = "assets/images/content";
					$upload_whitelist_extensions = array(".png", ".jpg", ".gif"); 
					try {
			
						$file_uploaded = $_FILES['file']['tmp_name'];
						$filename_uploaded = $_FILES['file']['name'];
						
						if(mb_strlen($filename_uploaded,"UTF-8") > 225 
							   OR preg_match("/[^-0-9A-Za-z_\.\ ]/i", $filename_uploaded)
						){
							throw new RuntimeException('Invalid image name!');
						}
						
						if(file_exists($file_uploaded)){
							$file_uploaded_ext = strrchr($filename_uploaded, '.');
						
							if (!(in_array(strtolower($file_uploaded_ext), $upload_whitelist_extensions))) {
							throw new RuntimeException('Invalid image format!');
							}
						
							if(file_exists($file_uploaded)){
							$file_type = $this->Mime($file_uploaded);
							
							if (!(in_array($file_type, $upload_whitelist_extensions))) {
								throw new RuntimeException('Invalid image type!');
							}
							}
						}else
							throw new RuntimeException('Invalid image upload!');
							
						$pictureLocalName = sha1_file($file_uploaded).$file_uploaded_ext;
						$picturePath = sprintf($newfolder.'/%s',
								$pictureLocalName
							);
						if (!move_uploaded_file($file_uploaded, $picturePath)) {
						   throw new RuntimeException('Failed to save the image!');
						}
			
					} catch (RuntimeException $e) {
						return $this->Response['error']['alert'] = $e->getMessage();
					}
				}elseif(empty($article_id))
					return $this->Response['error']['alert'] = 'Ooops article image missing!'.$article_id;
				
				if(!empty($article_id)){
					$AccDBQ = new \ArticlesQuery();
					
					$article = $AccDBQ->findPk($article_id);
					$url = $article->getUrl();
					
					//set slug manually
					if(empty($url)){
						$url = '/blog/';
						$url .= preg_replace('/[^\w]+/u', '-', $article->getTitle());
						
						$AccDBQ->filterById($article_id)->update(array('Url'=>$url));
					}
					
					if(!empty($this->userInput['data']['title']) && $article->getTitle()!=$this->userInput['data']['title'])
						$AccDBQ->filterById($article_id)->update(array('Title'=>$this->userInput['data']['title']));

					if(!empty($this->userInput['data']['content']) && $article->getContent()!=$this->userInput['data']['content'])
						$AccDBQ->filterById($article_id)->update(array('Content'=>$this->userInput['data']['content']));

					if(!empty($picturePath))
						$AccDBQ->filterById($article_id)->update(array('ImgPath'=>$picturePath));

				}else{
					$ArtDB = new \Articles();
					$ArtDB->setTitle($this->userInput['data']['title']);
					$ArtDB->setContent($this->userInput['data']['content']);
					$ArtDB->setImgPath($picturePath);
					$ArtDB->setUserId($_SESSION['userID']);
					$ArtDB->save();
					$url = $ArtDB->getSlug();
				}
				return $this->Response['successURL'] = '..'.$url;
				
				break;
			
			
			case "U":
			case "D":
				$this->Response['error']['alert'] = 'Invalid add article request!';
				break;
			
			case "R":
				$article = \ArticlesQuery::create()->findPk($article_id);
		
				if(!is_null($article)){
					
					 $this->Response = $article->toArray();
					
					 return;
				}
				
				
		}
    }
	
	
    public function ListArticles(){
		$this->HtmlView(array("Backend", "list"));

		switch($this->userInput['type']){
			case "R": //new article
				$article = \ArticlesQuery::create()->find();
				
				if(is_null($article)){
					return $this->Response['error']['alert'] = 'Articles not found!';
				}
				return $this->Response['data'] = $article->toArray();
				
			default:
				$this->Response['error']['alert'] = 'Invalid articles request!';
				break;
		}
		
	}

    public function DeleteArticle(){
		
        if(empty($article_id))
			$article_id = $this->RequestID;
		
		if(empty($article_id))
			return $this->Response['error-redirect'] = array('redir'=>'/backend/List-Articles','toCall'=>'backend/ListArticles', 'message'=>'Could not delete article: invalid id!');
		
		
		$AccDBQ = new \ArticlesQuery();
		
		$article = $AccDBQ->findPk($article_id);
	
		
		if(is_null($article)){
			return $this->Response['error-redirect'] = array('redir'=>'/backend/List-Articles','toCall'=>'backend/ListArticles', 'message'=>'Article '.$article_id.' for deletion not found!');
		}
		
		$article->delete();
		
		// delete picture
		if(!empty($article->getImgPath()))
			$picture_path = realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.$article->getImgPath());
		
		if(!empty($picture_path))
			unlink($picture_path);
		
		return $this->Response['error-redirect'] = array('redir'=>'/backend/List-Articles','toCall'=>'backend/ListArticles', 'message'=>'Article '.$article->getTitle().' <b>has been deleted!</b>');
		
		
	}

}