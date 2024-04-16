<div class="navegacion">

            

            <nav>

                <ul>

                <li id="cuenta" class="listas"><a href="">
                        <div class="text_icon-container">
                             <div class="icon-container">
                             <i class="fa-regular fa-user"></i>
                             </div>    
                             <div class="texto">Cuenta</div>
                        </div>
                        
                    </a>
                    <div class="cuenta-container">
                        <div class="cuenta-icon"><i class="fa-solid fa-user"></i></div>
                        <div class="nombre"><?php $nombre = $_SESSION['nombre']; echo "".$nombre;   ?></div>
                        
                        <a href="cerrarSesion.php">Cerrar Sesion</a>
                    </div>
                </li>

                    <li class="listas"><a href="Principal.php">
                        <div class="text_icon-container">
                             <div class="icon-container">
                             <i class="fa-solid fa-house"></i>
                             </div>    
                             <div class="texto">Inicio</div>
                        </div>
                        
                    </a></li>
                    
                    <li class="listas"><a href="ticket.php">
                    <div class="text_icon-container">
                        <div class="icon-container">
                        <i class="fa-solid fa-ticket"></i>
                        </div>
                        <div class="texto">Ticket</div>
                    </div>
                    </a></li>


                    <li class="listas"><a href="llamarTicket.php">
                    <div class="text_icon-container">
                        <div class="icon-container">
                        <i class="fa-solid fa-headset"></i>
                        </div>
                        <div class="texto">Llamar Tickets</div>
                    </div>
                    </a></li>

                    
                    
                    <li class="listas"><a href="Publicidad.php">
                    <div class="text_icon-container">
                        <div class="icon-container">
                        <i class="fa-solid fa-bullhorn"></i>
                        </div>
                        <div class="texto">Publicidad</div>
                    </div>
                    </a></li>

                    
                    
                </ul>

            </nav>

        </div>