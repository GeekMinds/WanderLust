<?php
/*
 * 
 * Template Name: Perfil Zapato
 */
get_header();
?>
<div id="contenedorPerfilZapato">
    <div class="ladoIzquierdo">
        <div class="sidebarMenu">
            <form id="formZapato" method="post">
                <a class="crear" href="javascript:void(0)">Crear Perfil</a>
                <br style="clear: both"/>
                <div id="fadeForm">
                    <label>Nombre del perfil</label>
                    <input type="text" name="nombrePerfil" id="nombrePerfil"/>
                    <label>complexión del pie</label>
                    <select class="complexion eleccion">
                        <option>Delgada</option>
                        <option>Normal</option>
                        <option>Ancha</option>
                    </select>
                    <label>Zapato para...</label>
                    <select class="generoZapato eleccion">
                        <option>Hombre</option>
                        <option>Mujer</option>
                        <option>Niño</option>
                    </select>
                    <label>Talla del zapato</label>
                    <input type="text" name="tallaZapato"/>
                    <button class="verLista">Ver listado de perfiles</button>
                </div>
            </form>
        </div>
    </div>
    <div class="ladoDerecho">
        <div id="perfilZapato">
            <h1>Listado de perfiles</h1>
            <div class="listado">
                <div class="sideLeft">
                    <ul>
                        <li>
                            <a href="javascript:void(0)">
                                listado 1
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                listado 2
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                listado 3
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                listado 4
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                listado 5
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="sideRight">

                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>
