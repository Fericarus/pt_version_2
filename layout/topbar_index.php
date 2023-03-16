<div class="topbar">

    <!-- Toggle -->
    <div class="toggle" id="toggle">
        <a onclick="toggle_activate()" href='javascript:void(0)' code-val='+val.codigo+'>
            <i class="fa-solid fa-bars"></i>
        </a>
        <p id="areaContador" class="hidden"></p>
    </div>

    <!-- Mensaje de bienvenida -->
    <div class="usuario usuario-index">
        <p>Bienvenido</p>
    </div>

</div>

<script>
    var pElement = document.getElementById("areaContador");
    var contador = 1;

    // Botón toggle_activate
    function toggle_activate() {

        contador++;

        if (contador % 2 == 0) {
            var navegacion = document.getElementById("navegacion");
            var main = document.getElementById("main");
            navegacion.style.left = "-300px";
            main.style.width = "100%";
            main.style.left = "0";
        } else {
            var navegacion = document.getElementById("navegacion");
            var main = document.getElementById("main");
            navegacion.style.left = "0px";
            main.style.left = "300px";
            main.style.width = "calc(100% - 300px)";
        }

    }
</script>