function validation(){
    
    var user_name = document.getElementById("user_name").value;

    if(user_name == " ") {
        alert("Você não preencheu o seu nome!");
        return false;
    } else {
        if(user_name.length < 3) {
            alert("Seu nome deve conter no minimo 3 letras!");
            return false;
        } else {
            return true;
        }
    }

    
}