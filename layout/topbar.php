<div class="topbar">
    <div class="toggle"><i class="fa-solid fa-bars"></i></div>

    <div class="buscar">
        <label>
            <input type="text" placeholder="Buscar">
            <i class="fa-solid fa-magnifying-glass"></i>
        </label>
    </div>

    <div class="usuario">
        <p>
                <?php
                echo "Bienvenido <strong>" . $_SESSION["nombre"] . "</strong>";
                ?>
        </p>
    </div>

</div>