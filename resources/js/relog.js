import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'
import "@fortawesome/fontawesome-free/css/all.css";

$(function(){
    const AudioSuccess= new Audio("/storage/audio/success.mp3");
    AudioSuccess.loop = false;
    AudioSuccess.controls = true;

    const AudioTime= new Audio("/storage/audio/tiempo.mp3");
    AudioTime.loop = true;
    AudioTime.controls = true;

    const AudioError= new Audio("/storage/audio/error.mp3");
    AudioError.loop = false;
    AudioError.controls = true;

    const AudioOpcion= new Audio("/storage/audio/opcion.mp3");
    AudioOpcion.loop = false;
    AudioOpcion.controls = true;

    var initial = $("input#tiempo").val() * 1000;
    var count = initial;
    var counter; //10 will  run it every 100th of a second
    var initialMillis;

    function timer() {
        if (count <= 0) {
            clearInterval(counter);
            return;
        }
        var current = Date.now();
        count = count - (current - initialMillis);
        initialMillis = current;
        displayCount(count);
    }

    function displayCount(count) {
        let res = Math.floor(count / 1000);
        let milliseconds = count.toString().substr(-3);
        let seconds = res;
        if (seconds <= 0 && milliseconds <= 0) {
            AudioTime.pause();
            document.getElementById("reloj_sg").classList.add("rojo");
            document.getElementById("reloj_cs").classList.add("rojo");
            document.getElementById("reloj_sg").innerHTML = 0;
            document.getElementById("reloj_cs").innerHTML = 0;
            AudioError.play();
            msg('warning','¡SE AGOTÓ EL TIEMPO; NO SE CONTESTO LA PREGUNTA!');
            $("input#seleccion").val('Tiempo agotado');
            $("input#opcion1").attr('disabled','disabled').attr('checked', false);
            $("input#opcion2").attr('disabled','disabled').attr('checked', false);
            $("input[type='checkbox']").prop('disabled','disabled');
            $("input[type='range']").attr('disabled',true);
            var t = $("input#tiempo").val()+".0";
            if($('input#validez').length && $('input#validez').val().length){$("input#validez").val(0);}
            if($('input#puntos').length && $('input#puntos').val().length){$("input#puntos").val(0);}
            $("div#resp").css("display","block");
            $("input#duracion").val(initial / 1000);
        } else {
            document.getElementById("reloj_sg").innerHTML = seconds;
            document.getElementById("reloj_cs").innerHTML = milliseconds;
        }

    }
    //mensajes
    function msg(icon,title){
        Swal.fire({
            position: 'center',
            icon: icon,
            title: title,
            showConfirmButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false
        });
    }
    //
    //iniciar cuenta regresiva
    //Verdadero y falso
    //$("input#opcion1 input#opcion2").attr("disabled","disabled");
    $('button#start1').on('click', function() {
        AudioTime.play();
        //$("input[name='opcion']").attr('disabled',false);
        $(this).prop('disabled',true);
        $("button#stop1").attr("disabled",false);
        document.getElementById("reloj_sg").classList.remove("rojo");
        document.getElementById("reloj_cs").classList.remove("rojo");
        clearInterval(counter);
        initialMillis = Date.now();
        counter = setInterval(timer, 1);
    });

    $("button#stop1").on("click",function(){
        //$("#OPT").css("display","block");
        $("input[name='opcion']").prop('disabled',false);
        $(this).prop('disabled',true);
        clearInterval(counter);
        AudioTime.pause();
        AudioOpcion.play();
        $("input#duracion").val((initial - count) / 1000);
    });

    //respuesta y resultado - verdadero y falso
    $("input[type='radio'][name='opcion']").on('change', function() {
        //revelar respuesta y resultado
        var respuesta = $("input#respuesta").val();
        var opcion = $("input:radio[name=opcion]:checked").val();
        let timerInterval
        let O = $("input:radio[name=opcion]:checked").data("text");
        Swal.fire({
            title: O,
            html: "Opción seleccionada",
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            timer: 2500,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        }).then((result) => {
            if(opcion == respuesta){
                AudioOpcion.pause();
                AudioSuccess.play();
                $("input#seleccion").val("["+O+"]");
                msg('success','¡RESPUESTA CORRECTA. FELICIDADES!');
                $("input#opcion1").attr('disabled','disabled').attr('checked', false);
                $("input#opcion2").attr('disabled','disabled').attr('checked', false);
                $("input#validez").val(1);
            }else{
                AudioOpcion.pause();
                AudioError.play();
                $("input#seleccion").val("["+O+"]");
                msg('error','¡RESPUESTA INCORRECTA. ¡SIGUE INTENTANDO!');
                $("input#opcion1").attr('disabled','disabled').attr('checked', false);
                $("input#opcion2").attr('disabled','disabled').attr('checked', false);
                $("input#validez").val(0);
            }
            $("div#resp").css("display","block");
        });

    });

    //Selección simple
    $('button#start2').on('click', function() {
        AudioTime.play();
        $(this).prop('disabled',true);
        $("button#stop2").attr("disabled",false);
        document.getElementById("reloj_sg").classList.remove("rojo");
        document.getElementById("reloj_cs").classList.remove("rojo");
        clearInterval(counter);
        initialMillis = Date.now();
        counter = setInterval(timer, 1);
    });

    $("button#stop2").on("click",function(){
        $((this)).prop('disabled',true);
        clearInterval(counter);
        AudioTime.pause();
        $("input[type='checkbox']").prop("disabled",false);
        $("input#duracion").val((initial - count) / 1000);
    });

    $("input[type='checkbox']").on('click', function(){
        AudioOpcion.play();
        var opcion = $("input[type='checkbox']:checked").val();
        var respuesta = $("input#respuesta_id").val();
        $("input[type='checkbox']").prop("disabled",true);
        let timerInterval
        let O = $("input[type='checkbox']:checked").data("text");
        Swal.fire({
            title: O,
            html: "Opción seleccionada",
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            timer: 2500,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
                if(opcion == respuesta){
                    AudioOpcion.pause();
                    AudioSuccess.play();
                    $("input#seleccion").val("["+O+"]");
                    msg('success','¡RESPUESTA CORRECTA. FELICIDADES!');
                    $("input#validez").val(1);
                }else{
                    AudioOpcion.pause();
                    AudioError.play();
                    $("input#seleccion").val("["+O+"]");
                    msg('error','¡RESPUESTA INCORRECTA. ¡SIGUE INTENTANDO!');
                    $("input#validez").val(0);
                }
                $("div#resp").css("display","block");
            }
        })
    });

    //Desarrollo
    $('button#start3').on('click', function() {
        AudioTime.play();
        $(this).prop('disabled',true);
        $("button#stop3").attr("disabled",false);
        document.getElementById("reloj_sg").classList.remove("rojo");
        document.getElementById("reloj_cs").classList.remove("rojo");
        clearInterval(counter);
        initialMillis = Date.now();
        counter = setInterval(timer, 1);
    });

    $("button#stop3").on('click', function() {
        clearInterval(counter);
        $("input#duracion").val((initial - count) / 1000);
        $(this).prop('disabled',true);
        //revelar respuesta y resultado
        $("div#resp").css("display","block");
        AudioTime.pause();
        AudioOpcion.play();
        $("div#val").html(0);
    });

    $("input[type='range']#opcion").on("input",function(){
        var opcion = $("input[type='range']#opcion").val();
        //var opcion = $(this).val();

        var puntos = $('input#puntos').val();
        if(opcion == 0 || opcion == "0"){
            $("input#seleccion").val('No fue válida');
            $("input#validez").val(0);
            AudioOpcion.pause();
            AudioError.play();
        }
        if((opcion >> 0) && (opcion << puntos)){
            $("input#validez").val(1);
            $("input#seleccion").val("Dentro de lo esperado");
        }
        if(opcion == puntos){
            $("input#validez").val(1);
            $("input#seleccion").val("Sobre lo esperado");
        }
        AudioOpcion.pause();
        AudioSuccess.play();
    });

    //mostrar respuesta correcta
    $("button#mensaje").on("click",function(){
        $("h2#R").css("display","block")
    });
    $("input#opcion").on("input",function(){
        $("div#val").html($(this).val());
    });
    //inicio de tiempo global
    displayCount(initial);
});
