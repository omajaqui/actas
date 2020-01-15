

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
            <div class="col-md-12"> 
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">REGISTRO REUNION O CAPACITACIÓN</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Fecha</label>
                                <input type="date" class="form-control" name="fecha" placeholder="Fecha">                        
                            </div>
                            <div class="form-group col-md-4">
                                <label>Hora Inicial: </label>
                                <input type="time" class="form-control" name="hInicio">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Hora Final: </label>
                                <input type="time" class="form-control" name="hFinal">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Lugar: </label>
                                <input type="text" class="form-control" name="lugar" Placeholder="Lugar">
                            </div>
                            <div class="form-group col-md-8">
                                <label>Actividad: </label>
                                <input type="text" class="form-control" name="actividad" Placeholder="Actividad">
                            </div>                        
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="card-header">
                                    <h3 class="card-title">Motivo de la reunion o capacitación</h3>                            
                                </div>
                                <textarea class="form-control" rows="4" name="motivo" placeholder="Enter ..."></textarea>
                            </div> 
                        </div>
                        <div class="row">                        
                            <div class="form-group col-md-6">
                                <div class="card-header">
                                    <h3 class="card-title">Temas a Tratar</h3>                            
                                </div>
                                <textarea class="form-control" rows="4" name="temas_tratar" placeholder="Enter ..."></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="card-header">
                                    <h3 class="card-title">Desarrollo</h3>                            
                                </div>
                                <textarea class="form-control" rows="4" name="desarrollo" placeholder="Enter ..."></textarea>
                            </div>
                        </div>
                        <div class="row" id="container_compromisos">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <h3 class="card-title">Compromisos</h3>                            
                                </div>
                            </div>
                            <div class="col-md-12">        
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4 col-xs-12">
                                            <h4>Agregar Compromiso</h4>
                                            <label>Acitividad: </label>
                                            <input type="text" class="form-control" v-model="actividad">
                                            <label>Responsable: </label>
                                            <input type="text" class="form-control" v-model="responsable">
                                            <label>Fecha: </label>
                                            <input type="date" class="form-control" v-model="date">
                                            <input type="button" class="btn btn-primary" value="Guardar" v-on:click="agregarComopromiso">
                                        </div>
                                        <div class="col-md-8 col-xs-12">
                                            <h4>Compromisos</h4>
                                            <table class="table">
                                                <tr>
                                                    <th>Actividad</th>
                                                    <th>Responsable</th>
                                                    <th>Fecha</th>
                                                </tr>
                                                <tr v-for="item in listaCompromiso">
                                                    <td v-text="item.actividad"></td>
                                                    <td v-text="item.responsable"></td>
                                                    <td v-text="item.date"></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div><br>                                    
                                </div>        
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <h3 class="card-title">Asistencia Reunion</h3>                            
                                </div>
                            </div>
                            <div class="col-md-12">        
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3 col-xs-12">
                                            <h4>Agregar Asistencia</h4>
                                            <select class="form-control" v-model="nombres">
                                                <option v-for="empleado in listaEmpleadosColegio" v-text="empleado.nombres"></option>
                                            </select>



                                            <!-- <label>Acitividad: </label>
                                            <input type="text" class="form-control" v-model="actividad">
                                            <label>Responsable: </label>
                                            <input type="text" class="form-control" v-model="responsable">
                                            <label>Fecha: </label>
                                            <input type="date" class="form-control" v-model="date">
                                            -->
                                            <input type="button" class="btn btn-primary" value="Guardar" v-on:click="agregarAsistencia"> 
                                        </div>
                                        <div class="col-md-9 col-xs-12">
                                            <h4>Lista Asistentes</h4>
                                            <table class="table">
                                                <tr>
                                                    <th>Nomrbes</th>
                                                    <th>Género</th>
                                                    <th>Cargo</th>
                                                    <th>Cédula</th>
                                                    <th>Correo</th>
                                                </tr>
                                                <tr v-for="asistente in listaAsistencia">
                                                    <td v-text="asistente.nombres"></td>
                                                    <td v-text="asistente.genero"></td>
                                                    <td v-text="asistente.cargo"></td>
                                                    <td v-text="asistente.cedula"></td>
                                                    <td v-text="asistente.email"></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div><br>                                    
                                </div>        
                            </div>
                        </div> 
                        
                        
                    </div>
                    <!-- /.card-body -->
                    <br><br><br>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block" v-on:click="validarForm">Guardar Formulario</button>
                    </div>
                    </form>
                </div>
            </div>    
        
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
   