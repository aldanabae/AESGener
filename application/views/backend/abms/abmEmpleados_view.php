<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			
			<div class="page-header">
				<h1>
					 Gestionar Empleados
				</h1>
			</div>				
					

		<!-- Empieza el cuadro Empleados -->	
		<form class="form-horizontal" role="form" action="<?php echo base_url() ?>abms/AbmEmpleados/mostrarTablaEmpleados" method="post"><!-- Comienza formulario -->
					
			<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">
				<div class="row">
					
					<div class="col-xs-6">
						<div class="dataTables_length" id="tipoTabla">
							<label>Mostrar Tipo Empleado
							<select aria-controls="dynamic-table" class="form-control input-sm" name="tipoTabla" OnChange= "tipoROnChange(this)">
								<option value="1">Todos</option>
								<option value="2">Administrador Sistema</option> -->
								<option value="3">Administrador Usuarios</option>
								<option value="4">Visualizador</option>						
							</select> 
							</label>
						</div>
					</div>

					<div class="col-xs-6">
						<div id="dynamic-table_filter" class="dataTables_filter">

							<label>Nº Legajo:
								<input type="search" class="form-control input-sm" placeholder="" name="nroLegajo" aria-controls="dynamic-table">
							</label>

							<button class="btn btn-greenAES btn-xs" type="submit" nombre="CargarTabla">
								<i class="ace-icon fa fa-search  bigger-110 icon-only"></i>
							</button>

						</div>
					</div>
				</div>


				<div id="todos" style="display:;">
					<table id="dynamic-table" class="table table-striped table-bordered table-hover">
						<thead>
								<tr>
									<th>Apellido y Nombre</th>
									<th>N° Legajo</th>
									<th>Nº Documento</th>
									<th>Teléfono</th>
									<th>E-Mail</th>
									<th>Convenio</th>
									<th>Tipo Empleado</th>
									<th>
										<div class="hidden-sm hidden-xs action-buttons text-center">
											<a class="greenAES" href="<?php echo base_url() ?>abms/AbmEmpleados/cargarNuevoEmpleado">
												<i class="ui-icon ace-icon fa fa-plus-circle greenAES bigger-130"></i>Agregar Empleado
											</a>
										</div> 
									</th>
								</tr>
						</thead>

						<tbody>

							<?php //Limitar los datos segun lo que trae el select de cantidad de lineas a mostrar
								if ($tablaEmpleados){
									$contador = 0;
										
									foreach($tablaEmpleados->result() as $tabla){
										if( $contador == $limiteTabla )  break;
							?>

							<tr>
								<td>
									<label class="pos-rel">
										<?php echo $tabla->apellidoE; ?> <?php echo $tabla->nombreE; ?>
									</label>
								</td>
								<td><?= $tabla->nroLegajo;?></td>
								<td><?= $tabla->dni;?></td>
								<td><?= $tabla->telefono;?></td>
								<td><?= $tabla->email;?></td>
								<td><?= $tabla->convenio;?></td>
								<td><?= $tabla->nombreTipoE;?></td><!-- Nombre via de administracion no codigo -->
								
								<td>
									<div class="hidden-sm hidden-xs action-buttons text-center">
											
											<a class="purple" href="<?php echo base_url()?>abms/AbmEmpleados/editarEmpleado/<?= $tabla->idEmpleado;?>">
												<i class="ace-icon fa fa-pencil bigger-130"></i>	
											</a>

											<a class="grey" href="<?php echo base_url()?>abms/AbmEmpleados/borrarEmpleado/<?= $tabla->idEmpleado;?>">
												<i class="ace-icon fa fa-trash-o bigger-130"></i>
											</a>
									</div>

									<div class="hidden-md hidden-lg">
											<div class="inline pos-rel">

												<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
													<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
												</button>

												<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
														
													<li>
														<a href="<?php echo base_url()?>abms/AbmEmpleados/editarEmpleado/<?= $tabla->idEmpleado;?>" class="tooltip-success" data-rel="tooltip" title="Edit">
															<span class="purple">
																<i class="ace-icon fa fa-pencil bigger-120"></i>
															</span>
														</a>
													</li>

													<li>
														<a href="<?php echo base_url()?>abms/AbmEmpleados/borrarEmpleado/<?= $tabla->idEmpleado;?>" class="tooltip-error" data-rel="tooltip" title="Delete">
															<span class="grey">
																<i class="ace-icon fa fa-trash-o bigger-120"></i>
															</span>
														</a>
													</li>
												</ul>
											</div>
									</div>
								</td>
							</tr>

							<?php	 $contador++;}
								}	
							?>

						</tbody>
					</table>
				</div> 


				<div id="admin" style="display:none;">
					<table id="dynamic-table" class="table table-striped table-bordered table-hover">
						<thead>
								<tr>
									<th>Apellido y Nombre</th>
									<th>N° Legajo</th>
									<th>Nº Documento</th>
									<th>Teléfono</th>
									<th>E-Mail</th>
									<th>Convenio</th>
									<th>Tipo Empleado</th>
									<th>
										<div class="hidden-sm hidden-xs action-buttons text-center">
											<a class="orange" href="<?php echo base_url() ?>abms/AbmEmpleados/cargarNuevoEmpleado">
												<i class="ui-icon ace-icon fa fa-plus-circle orange bigger-130"></i>Agregar Empleado
											</a>
										</div>
									</th>
								</tr>
						</thead>

						<tbody>

							<?php //Limitar los datos segun lo que trae el select de cantidad de lineas a mostrar
								if ($tablaEmpleados){
									$contador = 0;
										
									foreach($tablaEmpleados->result() as $tabla){
										if( $contador == $limiteTabla )    break;
											if($tabla->nombreTipoE == "Administrador"){
							?>

							<tr>
								<td>
									<label class="pos-rel">
										<?php echo $tabla->apellidoE; ?> <?php echo $tabla->nombreE; ?>
									</label>
								</td>
								<td><?= $tabla->nroLegajo;?></td>
								<td><?= $tabla->dni;?></td>
								<td><?= $tabla->telefono;?></td>
								<td><?= $tabla->email;?></td>
								<td><?= $tabla->convenio;?></td>
								<td><?= $tabla->nombreTipoE;?></td><!-- Nombre via de administracion no codigo -->
								
								<td>
									<div class="hidden-sm hidden-xs action-buttons text-center">
											
											<a class="green" href="<?php echo base_url()?>abms/AbmEmpleados/editarEmpleado/<?= $tabla->idEmpleado;?>">
												<i class="ace-icon fa fa-pencil bigger-130"></i>	
											</a>

											<a class="red" href="<?php echo base_url()?>abms/AbmEmpleados/borrarEmpleado/<?= $tabla->idEmpleado;?>">
												<i class="ace-icon fa fa-trash-o bigger-130"></i>
											</a>
									</div>

									<div class="hidden-md hidden-lg">
											<div class="inline pos-rel">

												<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
													<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
												</button>

												<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
														
													<li>
														<a href="<?php echo base_url()?>abms/AbmEmpleados/editarEmpleado/<?= $tabla->idEmpleado;?>" class="tooltip-success" data-rel="tooltip" title="Edit">
															<span class="green">
																<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
															</span>
														</a>
													</li>

													<li>
														<a href="<?php echo base_url()?>abms/AbmEmpleados/borrarEmpleado/<?= $tabla->idEmpleado;?>" class="tooltip-error" data-rel="tooltip" title="Delete">
															<span class="red">
																<i class="ace-icon fa fa-trash-o bigger-120"></i>
															</span>
														</a>
													</li>
												</ul>
											</div>
									</div>
								</td>
							</tr>

							<?php	 				}
									$contador++; }
								}	
							?>

						</tbody>
					</table>
				</div>


				<div id="adminDB" style="display:none;">
					<table id="dynamic-table" class="table table-striped table-bordered table-hover">
						<thead>
								<tr>
									<th>Apellido y Nombre</th>
									<th>N° Legajo</th>
									<th>Nº Documento</th>
									<th>Teléfono</th>
									<th>E-Mail</th>
									<th>Convenio</th>
									<th>Tipo Empleado</th>
									<th>
										<div class="hidden-sm hidden-xs action-buttons text-center">
											<a class="orange" href="<?php echo base_url() ?>abms/AbmEmpleados/cargarNuevoEmpleado">
												<i class="ui-icon ace-icon fa fa-plus-circle orange bigger-130"></i>Agregar Empleado
											</a>
										</div>
									</th>
								</tr>
						</thead>

						<tbody>

							<?php //Limitar los datos segun lo que trae el select de cantidad de lineas a mostrar
								if ($tablaEmpleados){
									$contador = 0;
										
									foreach($tablaEmpleados->result() as $tabla){
										if( $contador == $limiteTabla )    break;
											if($tabla->nombreTipoE == "Administrador de Usuarios"){
							?>

							<tr>
								<td>
									<label class="pos-rel">
										<?php echo $tabla->apellidoE; ?> <?php echo $tabla->nombreE; ?>
									</label>
								</td>
								<td><?= $tabla->nroLegajo;?></td>
								<td><?= $tabla->dni;?></td>
								<td><?= $tabla->telefono;?></td>
								<td><?= $tabla->email;?></td>
								<td><?= $tabla->convenio;?></td>
								<td><?= $tabla->nombreTipoE;?></td><!-- Nombre via de administracion no codigo -->
								
								<td>
									<div class="hidden-sm hidden-xs action-buttons text-center">
											
											<a class="green" href="<?php echo base_url()?>abms/AbmEmpleados/editarEmpleado/<?= $tabla->idEmpleado;?>">
												<i class="ace-icon fa fa-pencil bigger-130"></i>	
											</a>

											<a class="red" href="<?php echo base_url()?>abms/AbmEmpleados/borrarEmpleado/<?= $tabla->idEmpleado;?>">
												<i class="ace-icon fa fa-trash-o bigger-130"></i>
											</a>
									</div>

									<div class="hidden-md hidden-lg">
											<div class="inline pos-rel">

												<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
													<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
												</button>

												<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
														
													<li>
														<a href="<?php echo base_url()?>abms/AbmEmpleados/editarEmpleado/<?= $tabla->idEmpleado;?>" class="tooltip-success" data-rel="tooltip" title="Edit">
															<span class="green">
																<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
															</span>
														</a>
													</li>

													<li>
														<a href="<?php echo base_url()?>abms/AbmEmpleados/borrarEmpleado/<?= $tabla->idEmpleado;?>" class="tooltip-error" data-rel="tooltip" title="Delete">
															<span class="red">
																<i class="ace-icon fa fa-trash-o bigger-120"></i>
															</span>
														</a>
													</li>
												</ul>
											</div>
									</div>
								</td>
							</tr>
							<?php	 				}
									$contador++; }
								}	
							?>
						</tbody>
					</table>
				</div>


				<div id="visualizador" style="display:none;">
					<table id="dynamic-table" class="table table-striped table-bordered table-hover">
						<thead>
								<tr>
									<th>Apellido y Nombre</th>
									<th>N° Legajo</th>
									<th>Nº Documento</th>
									<th>Teléfono</th>
									<th>E-Mail</th>
									<th>Convenio</th>
									<th>Tipo Empleado</th>
									<th>
										<div class="hidden-sm hidden-xs action-buttons text-center">
											<a class="orange" href="<?php echo base_url() ?>abms/AbmEmpleados/cargarNuevoEmpleado">
												<i class="ui-icon ace-icon fa fa-plus-circle orange bigger-130"></i>Agregar Empleado
											</a>
										</div>
									</th>
								</tr>
						</thead>

						<tbody>

							<?php //Limitar los datos segun lo que trae el select de cantidad de lineas a mostrar
								if ($tablaEmpleados){
									$contador = 0;
										
									foreach($tablaEmpleados->result() as $tabla){
										if( $contador == $limiteTabla )    break;
											if($tabla->nombreTipoE == "Facilitador"){
							?>

							<tr>
								<td>
									<label class="pos-rel">
										<?php echo $tabla->apellidoE; ?> <?php echo $tabla->nombreE; ?>
									</label>
								</td>
								<td><?= $tabla->nroLegajo;?></td>
								<td><?= $tabla->dni;?></td>
								<td><?= $tabla->telefono;?></td>
								<td><?= $tabla->email;?></td>
								<td><?= $tabla->convenio;?></td>
								<td><?= $tabla->nombreTipoE;?></td><!-- Nombre via de administracion no codigo -->
								
								<td>
									<div class="hidden-sm hidden-xs action-buttons text-center">
											
											<a class="green" href="<?php echo base_url()?>abms/AbmEmpleados/editarEmpleado/<?= $tabla->idEmpleado;?>">
												<i class="ace-icon fa fa-pencil bigger-130"></i>	
											</a>

											<a class="red" href="<?php echo base_url()?>abms/AbmEmpleados/borrarEmpleado/<?= $tabla->idEmpleado;?>">
												<i class="ace-icon fa fa-trash-o bigger-130"></i>
											</a>
									</div>

									<div class="hidden-md hidden-lg">
											<div class="inline pos-rel">

												<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
													<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
												</button>

												<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
														
													<li>
														<a href="<?php echo base_url()?>abms/AbmEmpleados/editarEmpleado/<?= $tabla->idEmpleado;?>" class="tooltip-success" data-rel="tooltip" title="Edit">
															<span class="green">
																<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
															</span>
														</a>
													</li>

													<li>
														<a href="<?php echo base_url()?>abms/AbmEmpleados/borrarEmpleado/<?= $tabla->idEmpleado;?>" class="tooltip-error" data-rel="tooltip" title="Delete">
															<span class="red">
																<i class="ace-icon fa fa-trash-o bigger-120"></i>
															</span>
														</a>
													</li>
												</ul>
											</div>
									</div>
								</td>
							</tr>

							<?php	 				}
									$contador++; }
								}	
							?>

						</tbody>
					</table>
				</div>

			</div><!-- Termina el cuadro Empleados -->

		</form>


		</div><!-- /.page-content -->
	</div><!-- /.main-content-inner -->
</div><!-- /.main-content -->


<!-- Script para cuadro dinamico segun tipo de Empleado -->
	<script>
	function tipoROnChange(sel) {
	    if (sel.value=="1"){
	        	divT = document.getElementById("todos");
	      		divT.style.display = "";

	      		divA = document.getElementById("admin");
	      		divA.style.display = "none";

	      		divDB = document.getElementById("adminDB");
	      		divDB.style.display = "none";

	      		divV = document.getElementById("visualizador");
	      		divV.style.display = "none";

	    }else if (sel.value=="2"){
	     		divT = document.getElementById("todos");
	      		divT.style.display = "none";

	       		divA = document.getElementById("admin");
	      		divA.style.display = "";

	      		divDB = document.getElementById("adminDB");
	      		divDB.style.display = "none";

	      		divV = document.getElementById("visualizador");
	      		divV.style.display = "none";;

		}else if (sel.value=="3"){
	       		divT = document.getElementById("todos");
	      		divT.style.display = "none";

	       		divA = document.getElementById("admin");
	      		divA.style.display = "none";

	      		divDB = document.getElementById("adminDB");
	      		divDB.style.display = "";

	      		divV = document.getElementById("visualizador");
	      		divV.style.display = "none";

	    }else if (sel.value=="4"){
	       		divT = document.getElementById("todos");
	      		divT.style.display = "none";

	       		divA = document.getElementById("admin");
	      		divA.style.display = "none";

	      		divDB = document.getElementById("adminDB");
	      		divDB.style.display = "none";

	      		divV = document.getElementById("visualizador");
	      		divV.style.display = "";
	    }
	}
	</script>

<!--Para que se vean los botones de la tabla responsive-->

	<script type="text/javascript">
		window.jQuery || document.write("<script src='../../assets/js/jquery.js'>"+"<"+"/script>");
	</script>


	<script type="text/javascript">
		if('ontouchstart' in document.documentElement) document.write("<script src='../../assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
	</script>
	<script src="../../assets/js/bootstrap.js"></script>



