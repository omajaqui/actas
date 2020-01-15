<div class="row">
    <div class="col-md-12">
        <div class="card-header">
            <h3 class="card-title">Compromisos</h3>                            
        </div>
    </div>
    <div class="col-md-12">        
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <h1>Agregar Compromiso</h1>
                    <label>Acitividad: </label>
                    <input type="text" class="form-control" v-model="actividad">
                    <label>Responsable: </label>
                    <input type="text" class="form-control" v-model="responsable">
                    <label>Fecha: </label>
                    <input type="date" class="form-control" v-model="date">
                    <input type="button" class="btn btn-primary" value="Guardar" v-on:click="agregarCompromiso">
                </div>
                <div class="col-md-6 col-xs-12">
                    <h1>Compromisos</h1>
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
            </div>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <p class="text-center">Master2000</p>
                </div>
            </div>
        </div>        
    </div>
</div> 