var Alerts = {
	text: 'Error',
	icoclass: 'glyphicon-exclamation-sign',
	divclass: 'alert-danger',
	HTML: '',
	
	buildDOM: function(){
		
		var alertDIV = document.createElement('div');
		alertDIV.setAttribute('class', 'alert fade in '+ this.divclass);
		alertDIV.setAttribute('style', 'text-align:left;');
		
		var alertICO = document.createElement('span');
		alertICO.setAttribute('class', 'glyphicon '+ this.icoclass);
		alertICO.setAttribute('aria-hidden', 'true');
		
		var alertMessage = document.createElement('span');
		alertMessage.setAttribute('style', 'font-size:120%');
		alertMessage.innerHTML = '&nbsp;'+this.text;
		
		alertDIV.appendChild(alertICO);
		alertDIV.appendChild(alertMessage);
		
		this.HTML += alertDIV.outerHTML;
		
		return alertDIV;
	},
	
	danger: function(){
		this.icoclass = 'glyphicon-exclamation-sign';
		this.divclass = 'alert-danger';
	},

	warning: function(){
		this.icoclass = 'glyphicon-warning-sign';
		this.divclass = 'alert-warning';
	},

	success: function(){
		this.icoclass = 'glyphicon-ok-sign';
		this.divclass = 'alert-success';
	},

	info: function(){
		this.icoclass = 'glyphicon-info-sign';
		this.divclass = 'alert-info';
	},
	
	setType: function(type){
		switch(type){
			case "alert":
				this.danger();
				break;
			
			case "warn":
				this.warning();
				break;
			
			case "good":
				this.success();
				break;
			
			default:
				this.info();
		}
		
	},
	
	parse: function(alerts){
		
		this.HTML = '';
		var alertType = 'info';
		
		if(typeof alerts === "string"){
			this.text = alerts;
			this.setType(alertType);
		}
		
		if(typeof alerts === "object"){
			
			//find all known type of alerts
			if(alerts.error !== undefined){
				inAlerts = alerts.error;
				alertType = 'warn';
			}else if(alerts.success !== undefined){
				inAlerts = alerts.success;
				alertType = 'good';
			}else
				return false;
			
			if(typeof inAlerts === "string"){
				this.setType(alertType);
				this.text = inAlerts;
				this.buildDOM();
			}else{
				for(alertType in inAlerts){
					if(typeof inAlerts === "object"){
						
						var alerTXT = inAlerts[alertType];
						this.setType(alertType);
						
						if (typeof alerTXT === "string"){
							this.text = alerTXT;
							this.buildDOM();
						}
						
						if(Array.isArray(alerTXT)){
							for (i = 0; i < alerTXT.length; i++){
								this.text = alerTXT[i];
								this.buildDOM();
							}
						}
						
					}
				}
			}
		}
		
		return this.HTML;
	}
}

