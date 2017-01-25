// connect with the right particles section
if(particlesID !== 'undefined' || particlesHeight !=='undefined'){
	var findParticleDoc = document.getElementById(particlesID);
	
	if(findParticleDoc !== null){
		findParticleDoc.setAttribute('id', 'particles-js');
		findParticleDoc.setAttribute('style', 'position: absolute; width: 100%; height: '+particlesHeight+';');

	particlesJS("particles-js", particlesConf);

	
	
	}else
	
	console.log('Error: Particles JS cannot find '+particlesID+' element')
}