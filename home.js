function showinfo(id){
    document.getElementById("civilite").innerHTML = document.getElementById(id+"/5").value;
    document.getElementById("date").innerHTML = document.getElementById(id+"/2").value;
    document.getElementById("poste_").innerHTML = document.getElementById(id+"/7").value;
    document.getElementById("departement_").innerHTML = document.getElementById(id+"/8").value;
    document.getElementById("tel").innerHTML = document.getElementById(id+"/4").value;
    document.getElementById("mail").innerHTML = document.getElementById(id+"/3").value;
    document.getElementById("adresse").innerHTML = document.getElementById(id+"/6").value;
    document.getElementById("nom").innerHTML = document.getElementById(id+"/0").value;
    document.getElementById("prenom").innerHTML = document.getElementById(id+"/1").value;
}
