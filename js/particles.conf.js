// connect with the right particles section
if(particlesID !== 'undefined' || particlesHeight !=='undefined'){
	var findParticleDoc = document.getElementById(particlesID);
	console.log(findParticleDoc);
	if(findParticleDoc !== null){
		findParticleDoc.setAttribute('id', 'particles-js');
		findParticleDoc.setAttribute('style', 'position: absolute; width: 100%; height: '+particlesHeight+';');

		particlesJS("particles-js", particlesConf);

	}
}