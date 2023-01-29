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
    document.getElementById("suppr").value = document.getElementById(id+"/9").value;
    document.getElementById("id_poste").value = document.getElementById(id+"/11").value;
    document.getElementById("id_dep").value = document.getElementById(id+"/10").value;
}

function resetPopUp(){
    document.getElementById("popCivilite").value = "M";
    document.getElementById("popName").value = "";
    document.getElementById("popFirstName").value = "";
    document.getElementById("popEmail").value = "";
    document.getElementById("popPhone").value = "";
    document.getElementById("popAddress").value = "";
    document.getElementById("popArrivalDate").value = "";
    document.getElementById("popIdPost").value = "";
    document.getElementById("popIdDepartment").value = "";
    document.getElementById("popIdPost").value = 1;
    document.getElementById("popIdDepartment").value = 1;
}

function setPopUp(){
    document.getElementById("popCivilite").value = document.getElementById("civilite").innerHTML;
    document.getElementById("popName").value = document.getElementById("nom").innerHTML;
    document.getElementById("popFirstName").value = document.getElementById("prenom").innerHTML;
    document.getElementById("popEmail").value = document.getElementById("mail").innerHTML;
    document.getElementById("popPhone").value = document.getElementById("tel").innerHTML;
    document.getElementById("popAddress").value = document.getElementById("adresse").innerHTML;
    document.getElementById("popArrivalDate").value = document.getElementById("date").innerHTML;
    document.getElementById("popIdPost").value = document.getElementById("id_poste").value;
    document.getElementById("popIdDepartment").value = document.getElementById("id_dep").value;
}