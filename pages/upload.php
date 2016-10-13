			<div class="modal" id="myModal" tabindex="-1" role="dialog"aria-labelledby="myModalLabel1" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<form action="index.php" method="post" enctype="multipart/form-data">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="modal-title" id="myModalLabel1">Добавить картинку</h4>
							</div>
							<div class="modal-body">

								<div class="input-group has-success">
									<span class="input-group-addon">Заголовок изображения</span>
									<input type="text" name="title" class="form-control form-control-success" />
								</div>

								<div class ="form-group has-success">
									<label for="content">Описание изображения</label>
									<textarea name="content"  class="form-control form-control-success"></textarea>
								</div>

								<div class="input-group has-success">
									<span class="input-group-addon">Выберите изображение</span>
									<input type="file" name="file[]"  accept="image/*" class="form-control"/>
								</div>

								<?php 
								$pdo = Tools::Connect();
								if (isset($_POST['addimg']))
								{
									$path = "images/";

									foreach ($_FILES['file']['name'] as $k => $v)
									{
										if ($_FILES['file']['error'][$k]>0) continue; 

										if (move_uploaded_file($_FILES['file']['tmp_name'][$k], $path.$v)) 
										{

											$title = trim(htmlspecialchars($_POST['title']));
											$content = trim(htmlspecialchars($_POST['content']));
											$ins='insert into image(imagepath,title, content) values("'.$path.$v.'","'.$title.'","'.$content.'")';
											$pdo->query($ins);

											echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">';
											echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
											echo '<span aria-hidden="true">&times;</span>';
											echo '</button>';
											echo '<strong>Очень хорошо!</strong> Ваша картинка загружена в базу.';
											echo '</div>';
										}
									}
								}
								?>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Закрыть</button>
								<input type="submit" name="addimg" value="Добавить изображение"  class="btn btn-outline-success"/>
							</div>
						</div>
						</form>
					</div>
				</div>
