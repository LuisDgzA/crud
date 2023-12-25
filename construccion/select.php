<?php 
							include("../conexion.php");
							$query_rol = mysqli_query($conexion, "SELECT * FROM analisis");
							mysqli_close($conexion);
							$resultado_rol = mysqli_num_rows($query_rol);
							if ($resultado_rol > 0) {
								while ($rol = mysqli_fetch_array($query_rol)) {
							?>
									<option value="<?php echo $rol["id_analisis"]; ?>"><?php echo $rol["nombre_a"]  ?></option>
							<?php

								}
							}
						?>