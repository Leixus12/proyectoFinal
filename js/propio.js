 $(window).on('load',function(){$('#status').fadeOut();$('#preloader')
          .fadeOut('fast');$('body').delay(350).css({'overflow':'visible'});})
 
 
 function campTxt1(String){
            var out = '';
            var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHJIKLMNÑOPQRTSUVWXYZáéíóúÁÉÍÓÚ ';
            for (var i=0; i<String.length;i++)
                if (filtro.indexOf(String.charAt(i)) != -1){
                    out += String.charAt(i);
                    document.getElementById("campTxt1").innerHTML="";
                }else{
                document.getElementById("campTxt1").innerHTML=" No puedes ingresar números en este campo";
                }
                    
            return out;
 }
 
 
function campTxt2(String){
    var out = '';
    var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHJIKLMNÑOPQRTSUVWXYZáéíóúÁÉÍÓÚ ';
    for (var i=0; i<String.length;i++)
        if (filtro.indexOf(String.charAt(i)) != -1){
            out += String.charAt(i);
            document.getElementById("campTxt2").innerHTML="";
        }else{
        document.getElementById("campTxt2").innerHTML=" No puedes ingresar números en este campo";
        }

    return out;
}


function campTxt3(String){
    var out = '';
    var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHJIKLMNÑOPQRTSUVWXYZáéíóúÁÉÍÓÚ ';
    for (var i=0; i<String.length;i++)
        if (filtro.indexOf(String.charAt(i)) != -1){
            out += String.charAt(i);
            document.getElementById("campTxt3").innerHTML="";
        }else{
        document.getElementById("campTxt3").innerHTML=" No puedes ingresar números en este campo";
        }

    return out;
}
        
        
function campNum1(String){
    var out = '';
    var filtro = '0123456789';
    for (var i=0; i<String.length;i++)
        if (filtro.indexOf(String.charAt(i)) != -1){
            out += String.charAt(i);document.getElementById("campNum1").innerHTML="";
        }else{
        document.getElementById("campNum1").innerHTML=" No puedes ingresar letras en este campo";
        }

    return out;
}


function campNum2(String){
    var out = '';
    var filtro = '0123456789';
    for (var i=0; i<String.length;i++)
        if (filtro.indexOf(String.charAt(i)) != -1){
            out += String.charAt(i);document.getElementById("campNum2").innerHTML="";
        }else{
        document.getElementById("campNum2").innerHTML=" No puedes ingresar letras en este campo";
        }

    return out;
}