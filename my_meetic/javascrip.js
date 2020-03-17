function validateForm() {
	var valid = true;
    
	//Verif nom
    var nom = document.forms.html.nom.value;
    if (nom == "") {
    	document.getElementById("alert-nom").innerHTML = "Veuillez remplir ce champ";
        document.getElementById("nom").style.backgroundColor = "orange";
        valid = false;
    }
    else if (nom.length < 2) {
    	document.getElementById("alert-nom").innerHTML = "Inserer au moins 2 caracteres.";
    	document.getElementById("nom").style.backgroundColor = "white";
    	valid = false;
    }
    else if (/^[a-zA-Z]+$/.test(nom) == false) {
    	document.getElementById("alert-nom").innerHTML = "Veuillez uniquement inserer des lettres.";
    	document.getElementById("nom").style.backgroundColor = "white";
    	valid = false;
    }
    else if (nom.length >= 2) {
    	document.getElementById("alert-nom").innerHTML = "";
    	document.getElementById("nom").style.backgroundColor = "white";
    }

    //Verif prenom
    var prenom = document.forms.html.prenom.value;
    if (prenom == "") {
    	document.getElementById("alert-prenom").innerHTML = "Veuillez remplir ce champ";
        document.getElementById("prenom").style.backgroundColor = "orange";
        valid = false;
    }
    else if (prenom.length < 2) {
    	document.getElementById("alert-prenom").innerHTML = "Inserer au moins 2 caracteres.";
    	document.getElementById("prenom").style.backgroundColor = "white";
    	valid = false;   	
    }
    else if (/^[a-zA-Z]+$/.test(prenom) == false) {
    	document.getElementById("alert-prenom").innerHTML = "Veuillez uniquement inserer des lettres.";
    	document.getElementById("prenom").style.backgroundColor = "white";
    	valid = false;
    }
    else if (prenom.length >= 2) {
    	document.getElementById("alert-prenom").innerHTML = "";
    	document.getElementById("prenom").style.backgroundColor = "white";
    }

    //Verif mail
    var mail = document.forms.html.email.value;
    if (mail == "") {
        document.getElementById("alert-email").innerHTML = "Veuillez remplir ce champ";
        document.getElementById("email").style.backgroundColor = "orange";
        valid = false;
    }
    else if (/\S+@\S+\.\S+/.test(mail) == false) {
    	document.getElementById("alert-email").innerHTML = "Veuillez entrer une adresse mail valide.";
    	document.getElementById("email").style.backgroundColor = "white";
    	valid = false;
    }
    else {
    	document.getElementById("alert-email").innerHTML = "";
    	document.getElementById("email").style.backgroundColor = "white";
    }

    //Verif telephone
    var telephone = document.forms.html.telephone.value;
    if (telephone == "") {
        document.getElementById("alert-telephone").innerHTML = "Veuillez remplir ce champ";
    	document.getElementById("telephone").style.backgroundColor = "orange";
    	valid = false;
    }
    else if (/^[0-9]+$/.test(telephone) == false) {
    	document.getElementById("alert-telephone").innerHTML = "Veuillez entrer un numero valide.";
    	document.getElementById("telephone").style.backgroundColor = "white";
    	valid = false;
    }
    else {
    	document.getElementById("alert-telephone").innerHTML = "";
    	document.getElementById("telephone").style.backgroundColor = "White";
    }

    //Verif site
    var website = document.forms.html.website.value;
    if (website == "") {
    	document.getElementById("website").style.backgroundColor = "orange";
    	valid = false;
    }
    else {
    	document.getElementById("website").style.backgroundColor = "White";
    }

    //Verif date
    var date = document.forms.html.date.value;
    if (date == "") {
    	document.getElementById("date").style.backgroundColor = "orange";
    	valid = false;
    }
    else {
    	document.getElementById("date").style.backgroundColor = "White";
    }

    // //Verif mot de passe
    // var log = document.forms.html2.log.value;
    // if (date == ""){
    //     document.getElementById("log").style.backgroundColor = "orange";
    //     valid = false;
    // }
    // else {
    //     document.getElementById("log").style.backgroundColor = "white";
    // }

    return valid;
}

