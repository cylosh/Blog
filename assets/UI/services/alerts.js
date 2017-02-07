var Alerts = {
	text: 'Error',
	icoclass: 'glyphicon-exclamation-sign',
	divclass: 'alert-danger',
	
	buildHTML: function(){
		
		var alertDIV = document.createElement('div');
		alertDIV.setAttribute('class', 'alert fade in '+ this.divclass);
		alertDIV.setAttribute('style', 'text-align:left;');
		
		var alertICO = document.createElement('span');
		alertICO.setAttribute('class', 'glyphicon '+ this.icoclass);
		alertICO.setAttribute('aria-hidden', 'true');
		
		var alertMessage = document.createElement('span');
		alertMessage.setAttribute('style', 'font-size:120%');
		alertMessage.innerHTML = this.text;
		
		alertDIV.appendChild(alertICO);
		alertDIV.appendChild(alertMessage);
		
		return alertDIV;
	},
	
	warn: function(message){
		this.text = '&nbsp;'+message+Math.random();
		this.icoclass = 'glyphicon-exclamation-sign';
		this.divclass = 'alert-danger';
		
		return this.buildHTML();
	}
	
}

