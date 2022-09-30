<?php @include "sources/editor.php" ?>
<?php

$sptangkem = $d->o_fet("select * from #_sp_khuyen_mai where trang_thai = 1");
$nhasanxuat = $d->o_fet("select * from #_extra where type = 1 order by stt asc");
?>
<ol class="breadcrumb">
	<li><a href="<?= urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
	<li class="active"><a href="<?= urladmin ?>index.php">Danh mục</a></li>
	<li class="active"><a href="<?= urladmin ?>index.php?p=san-pham&a=man">Sản phẩm</a></li>
	<li class="active"><a href="#"><?php if (isset($_GET['id'])) echo "Sửa";
									else echo "Thêm mới" ?></a></li>
</ol>
<div class="col-xs-12">
	<form name="CHm" method="post" action="index.php?p=san-pham&a=save&id=<?= @$_REQUEST['id'] ?>&page=<?= @$_REQUEST['page'] ?>" enctype="multipart/form-data">

		<div class="ar_admin">
			<div class="title_thongtinchung">
				Thông tin chung
			</div>
			<table class="table table-bordered table-hover them_dt" style="border:none">
				<tbody>
					<?php if (isset($_GET['id'])) { ?>
						<tr>
							<td class="td_left">
								Hình ảnh:
							</td>
							<td class="td_right">
								<?php if ($items[0]['hinh_anh'] <> '') { ?>
									<img src="../img_data/images/<?php echo @$items[0]['hinh_anh'] ?>" width="120" alt="NO PHOTO" />
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
					<tr>
						<td class="td_left">
							Hình ảnh:
						</td>
						<td class="td_right">
							<label for="">Tỉ lệ hình ảnh phù hợp (3:2)</label>
							<input type="file" name="file2" class="input width400 form-control" />
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Hình ảnh slide:
						</td>
						<td class="td_right ">
							<div class="td_hinhanh">
								<?php
								$hinhanh =  $d->o_fet("select * FROM #_sanpham_hinhanh where id_sp ='" . $_GET['id'] . "'");
								foreach ($hinhanh as $val) {
								?>
									<div class="dv-img-ad">
										<div class="img_addimage">
											<img src="../img_data/images/<?php echo @$val['hinh_anh'] ?>">
										</div>
										<div class="icon_deleteimage">
											<a href="javascript:xoa_anh_sp('<?= $val['id'] ?>','<?= $val['id_sp'] ?>')" onclick="if(!confirm('Xác nhận xóa?')) return false;  "><img src="public/images/delete.png" alt="Delete"></a>
										</div>
										<div class="name_addimg"><?php echo @$val['title'] ?></div>
									</div>
								<?php } ?>
							</div>
							<div class="add_img">

							</div>
							<div style="clear:both"></div>
							<div style=""><a href="javascript:them_anh()" style="  background-color: rgb(66, 139, 202);  padding: 5px 22px;  border-radius: 3px;  color: #fff;  text-decoration: none;">Thêm ảnh</a></div>
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Danh mục:
						</td>
						<td class="td_right">
							<select name="id_loai" class="input width400 form-control" style="border-radius:4px">
								<option value="0">Chọn danh mục</option>
								<?= $loai ?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="td_left">
							Mã sản phẩm:
						</td>
						<td class="td_right">
							<?php if (isset($_GET['id'])) { ?>
								<input class="input width400 form-control" type="text" name="ma_sp" value="<?php echo @$items[0]['ma_sp'] ?>" />
							<?php } else { ?>
								<input class="input width400 form-control" type="text" name="ma_sp" value="<?= $d->chuoird(4); ?>" />
							<?php } ?>
						</td>
					</tr>

					<tr>
						<td class="td_left">
							Giá:
						</td>
						<td class="td_right">
							<input class="input width400 form-control" autocomplete="off" OnkeyUp="gia_khuyen_mai(this,'#gia_km')" type="text" name="gia" id="gia" value="<?php echo @$items[0]['gia'] ?>" />
							<font id="gia_km">
								<p style="margin-top:5px;color:red"><?php if (!empty($items[0]['gia'])) echo $d->vnd($items[0]['gia']) ?></p>
							</font>
						</td>
					</tr>
					<!-- <tr>
						<td class="td_left">
							Link video youtube:
						</td>
						<td class="td_right">
							<input class="input width400 form-control" name="video" id="video" value="<?php echo @$items[0]['video'] ?>" />
						</td>
					</tr> -->

					<tr>
						<td class="td_left">
							Link tài liệu:
						</td>
						<td class="td_right">
							<input type="file" class="input width400 form-control" name="doc" id="doc" value="<?php echo @$items[0]['doc'] ?>" />
							<?php
							if ($items[0]['doc']) {
							?>
								<div><input name="detetefile" type="checkbox"> Xóa tài liệu: <?= $items[0]['doc'] ?></div>
							<?php } ?>
						</td>
					</tr>

					<!-- <tr>
				<td class="td_left">
						Khuyến mãi:
				</td>
				<td class="td_right">
					<input class="input width400 form-control" autocomplete="off" OnkeyUp="gia_khuyen_mai(this,'#km')" type="text" name="khuyen_mai" id="khuyen_mai" value="<?php echo @$items[0]['khuyen_mai'] ?>"  />
					<font id="km"><p style="margin-top:5px;color:red"><?php if (!empty($items[0]['khuyen_mai'])) echo $d->vnd($items[0]['khuyen_mai']) ?></p></font>
				</td>
			</tr> -->
					<!-- <tr>
						<td class="td_left tv">
						</td>
						<td class="td_right">
							Chọn 1 trong 2 link (video, tài liệu)
						</td>
					</tr> -->

				</tbody>
			</table>
		</div>

		<div class="ar_admin">
			<div class="title_thongtinchung">
				Cấu hình màu sắc
			</div>
			<table class="table table-bordered table-hover them_dt" style="border:none">
				<tbody>

					<tr>
						<td class="td_left">
							Chọn màu sắc
						</td>
						<td class="td_right">
							<?php
							$color = $d->o_fet("select * from #_people order by id");
							?>
							<select id="colors" multiple name="color[]" class="select2 input width400 form-control" style="border-radius:4px">
								<?php foreach ($color as $key => $item) { ?>
									<option value="<?= $item['id'] ?>"><?= $item['ten_' . $_SESSION['lang']] ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>

					<tr>
						<td class="td_left">
							Chọn dung lượng
						</td>
						<td class="td_right">
							<?php
							$size = $d->o_fet("select * from #_size order by id");
							?>
							<input type="hidden" id="sizesValue" name="sizesValue" />
							<select id="sizes" multiple name="size[]" class="select2 input width400 form-control" style="border-radius:4px">
								<?php foreach ($size as $key => $item) { ?>
									<option value="<?= $item['id'] ?>"><?= $item['ten_' . $_SESSION['lang']] ?></option>
								<?php } ?>
							</select>

							<div id="group__input__size"></div>
						</td>
					</tr>

				</tbody>
			</table>
		</div>

		<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
			<ul id="myTabs" class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#id_viet" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Ngôn ngữ VN </a>
				</li>
				<!-- <li role="presentation" class="">
					<a href="#id_us" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ EN</a>
				</li>
				<li role="presentation" class="">
					<a href="#id_ch" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ Japan</a>
				</li> -->
				<li role="presentation" class="">
					<a href="#id_seo" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Hỗ trợ SEO</a>
				</li>
			</ul>
			<div id="myTabContent" class="tab-content">
				<div role="tabpanel" class="tab-pane fade active in" id="id_viet" aria-labelledby="home-tab">
					<!-- //lang viet -->
					<div class="ar_admin">
						<table class="table table-bordered table-hover them_dt" style="border:none">
							<tbody>
								<tr>
									<td class="td_left">
										Tiêu đề :
									</td>
									<td class="td_right">
										<input class="input width400 form-control" OnkeyUp="addText(this,'#alias_vn','#title_vn')" id="ten_vn" name="ten_vn" value="<?php echo @$items[0]['ten_vn'] ?>" />
									</td>
								</tr>
								<tr>
									<td class="td_left">
										Đường dẫn:
									</td>
									<td class="td_right">
										<input class="input width400 form-control" name="alias_vn" id="alias_vn" value="<?php echo @$items[0]['alias_vn'] ?>" OnkeyUp="addText(this,'#alias_vn')" />
									</td>
								</tr>

								<tr>
									<td class="td_left">
										Mô tả:
									</td>
									<td class="td_right">
										<textarea class="input width400 form-control" style="height:80px" name="mo_ta_vn" id="mo_ta_vn"><?= @$items[0]['mo_ta_vn'] ?></textarea>
										<?php $ckeditor->replace('mo_ta_vn'); ?>
									</td>
								</tr>


								<tr>
									<td class="td_left">
										Nội dung chi tiết:
									</td>
									<td class="td_right">
										<textarea name="thong_tin_vn" id="thong_tin_vn"><?= @$items[0]['thong_tin_vn'] ?></textarea>
										<?php $ckeditor->replace('thong_tin_vn'); ?>
									</td>
								</tr>
								<tr>
									<td class="td_left">
										Thông số khác:
									</td>
									<td class="td_right">
										<textarea name="thong_so_vn" id="thong_tin_vn"><?= @$items[0]['thong_so_vn'] ?></textarea>
										<?php $ckeditor->replace('thong_so_vn'); ?>
									</td>
								</tr>
								<!-- <tr>
                                            <td class="td_left">
                                                Hướng dẫn thanh toán:
                                            </td>
                                            <td class="td_right">
                                                <textarea  name="video" id="thong_tin_vn"><?= @$items[0]['video'] ?></textarea>
                                                <?php $ckeditor->replace('video'); ?>
                                            </td>
					</tr -->
							</tbody>
						</table>
					</div>
					<!-- end -->
				</div>
				<div role="tabpanel" class="tab-pane fade" id="id_us" aria-labelledby="profile-tab">
					<!-- lang us -->
					<div class="ar_admin">
						<table class="table table-bordered table-hover them_dt" style="border:none">
							<tbody>
								<tr>
									<td class="td_left">
										Tiêu đề (en):
									</td>
									<td class="td_right">
										<input class="input width400 form-control" OnkeyUp="addText(this,'#alias_us','#title_us')" id="ten_us" name="ten_us" value="<?php echo @$items[0]['ten_us'] ?>" />
									</td>
								</tr>

								<tr>
									<td class="td_left">
										Đường dẫn (en):
									</td>
									<td class="td_right">
										<input class="input width400 form-control" name="alias_us" id="alias_us" value="<?php echo @$items[0]['alias_us'] ?>" OnkeyUp="addText(this,'#alias_us')" />
									</td>
								</tr>

								<tr>
									<td class="td_left">
										Mô tả (en):
									</td>
									<td class="td_right">
										<textarea class="input width400 form-control" style="height:80px" name="mo_ta_us" id="mo_ta_us"><?= @$items[0]['mo_ta_us'] ?></textarea>
									</td>
								</tr>


								<tr>
									<td class="td_left">
										Nội dung chi tiết (en):
									</td>
									<td class="td_right">
										<textarea name="thong_tin_us" id="thong_tin_us"><?= @$items[0]['thong_tin_us'] ?></textarea>
										<?php $ckeditor->replace('thong_tin_us'); ?>
									</td>
								</tr>
							</tbody>
						</table>
						<!-- end -->
					</div>
				</div>

				<div role="tabpanel" class="tab-pane fade" id="id_ch" aria-labelledby="profile-tab">
					<!-- lang ch -->
					<div class="ar_admin">
						<table class="table table-bordered table-hover them_dt" style="border:none">
							<tbody>
								<tr>
									<td class="td_left">
										Tiêu đề (ja):
									</td>
									<td class="td_right">
										<input class="input width400 form-control" OnkeyUp="addText(this,'#alias_ch','#alias_ch')" id="ten_ch" name="ten_ch" value="<?php echo @$items[0]['ten_ch'] ?>" />
									</td>
								</tr>

								<tr>
									<td class="td_left">
										Đường dẫn (ja):
									</td>
									<td class="td_right">
										<input class="input width400 form-control" name="alias_ch" id="alias_ch" value="<?php echo @$items[0]['alias_ch'] ?>" OnkeyUp="addText(this,'#alias_ch')" />
									</td>
								</tr>

								<tr>
									<td class="td_left">
										Mô tả (ja):
									</td>
									<td class="td_right">
										<textarea class="input width400 form-control" style="height:80px" name="mo_ta_ch" id="mo_ta_ch"><?= @$items[0]['mo_ta_ch'] ?></textarea>
									</td>
								</tr>


								<tr>
									<td class="td_left">
										Nội dung chi tiết (ja):
									</td>
									<td class="td_right">
										<textarea name="thong_tin_ch" id="thong_tin_ch"><?= @$items[0]['thong_tin_ch'] ?></textarea>
										<?php $ckeditor->replace('thong_tin_ch'); ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- end -->
				</div>

				<div role="tabpanel" class="tab-pane fade" id="id_seo" aria-labelledby="profile-tab">
					<!-- /seo -->
					<div class="ar_admin">
						<table class="table table-bordered table-hover them_dt" style="border:none">
							<tbody>
								<tr>
									<td class="td_left">
										Title:
									</td>
									<td class="td_right">
										<input class="input width400 form-control" autocomplete="off" type="text" name="title_vn" id="title_vn" value="<?php echo @$items[0]['title_vn'] ?>" />
									</td>
								</tr>
								<!--tr>
						<td class="td_left">
							Title (en):
						</td>
						<td class="td_right">
							<input class="input width400 form-control" autocomplete="off"  type="text" name="title_us" id="title_us" value="<?php echo @$items[0]['title_us'] ?>"  />
						</td>
					</tr-->
								<!--tr>
						<td class="td_left">
							Title (ja):
						</td>
						<td class="td_right">
							<input class="input width400 form-control" autocomplete="off"  type="text" name="title_ch" id="title_ch" value="<?php echo @$items[0]['title_ch'] ?>"  />
						</td>
					</tr-->
								<tr>
									<td class="td_left">
										Keyword:
									</td>
									<td class="td_right">
										<textarea class="input width400 form-control" style="height:70px" name="keyword" id="keyword"><?= @$items[0]['keyword'] ?></textarea>
									</td>
								</tr>

								<tr>
									<td class="td_left">
										Description:
									</td>
									<td class="td_right">
										<textarea class="input width400 form-control" style="height:70px" name="des" id="des"><?= @$items[0]['des'] ?></textarea>
									</td>
								</tr>
							</tbody>
						</table>
						<!-- end -->
					</div>
				</div>


				<div class="ar_admin last">
					<table class="table table-bordered table-hover tv them_dt" style="border:none">
						<tbody>
							<tr>
								<td class="td_left tv">
									Tác vụ:
								</td>
								<td class="td_right">
									<input type="checkbox" class="chkbox" name="sp_hot" <?php if (isset($items[0]['sp_hot'])) {
																							if (@$items[0]['sp_hot'] == 1) echo 'checked="checked"';
																							else echo '';
																						} ?> id="sp_hot"><label class="lb_nut" for="sp_hot">Home</label>

									<!-- <input type="checkbox" class="chkbox" name="sp_moi" <?php if (isset($items[0]['sp_moi'])) {
																									if (@$items[0]['sp_moi'] == 1) echo 'checked="checked"';
																									else echo '';
																								} ?> id="sp_moi"><label class="lb_nut" for="sp_moi">Nổi bật</label> -->
									<input type="checkbox" class="chkbox" name="tieu_bieu" <?php if (isset($items[0]['tieu_bieu'])) {
																								if (@$items[0]['tieu_bieu'] == 1) echo 'checked="checked"';
																								else echo '';
																							} ?> id="tieu_bieu"><label class="lb_nut" for="tieu_bieu">SP Tiêu biểu</label>
									<input type="checkbox" class="chkbox" name="hien_thi" <?php if (isset($items[0]['hien_thi'])) {
																								if (@$items[0]['hien_thi'] == 1) echo 'checked="checked"';
																							} else echo 'checked="checked"'; ?> id="hien_thi"><label class="lb_nut" for="hien_thi">Hiển thị</label>
								</td>
							</tr>
							<div class="clear"></div>
							<tr>
								<td class="td_left tv" style="text-align:right">
								</td>
								<td class="td_right">
									<input type="submit" value="Lưu" class="btn btn-primary" />
									<input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=san-pham&a=man'" class="btn btn-primary" />
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
	function addText(text, target, title) {
		var str = $(text).val();
		var link = locdau(str);
		$(target).val(link);
		$(title).val(str);
	}

	function xoa_anh_sp(id, idsp) {
		$.ajax({
			url: "./sources/ajax_xoaanh_sp.php",
			type: 'POST',
			data: "id=" + id + "&idsp=" + idsp,
			success: function(data) {
				$(".td_hinhanh").html(data);
			}
		})
	}

	var fs_img = 0;

	function them_anh() {
		fs_img++;
		if (fs_img < 16) {
			$(".add_img").append('<div class="dv-img-ad hide_js_' + fs_img + '"><input type="hidden" name="txt_up_' + fs_img + '" class="txt_up_' + fs_img + '"  value="1"><input type="file" class="file_img" name="file_' + fs_img + '"><input type="text" name="title' + fs_img + '" placeholder="Tên sản phẩm" style="margin-top:5px;"/><a class="delete-img" href="javascript:;" onclick="xoa_anh_up(\'' + fs_img + '\')"> Xóa </a></div>');
		} else {
			alert("Mỗi lần up tối đa 15 ảnh.");
		}
	}

	function xoa_anh_up(id) {
		$(".hide_js_" + id).hide();
		$(".txt_up_" + id).val("0");

	}

	function gia_khuyen_mai(obj, val) {
		var gia = $(obj).val();
		var km = "";
		if (gia == '') gia = 0;
		$.ajax({
			url: "./sources/giakm.php",
			type: 'POST',
			data: "gia=" + gia + "&khuyenmai=" + km,
			success: function(data) {
				$(val).html(data);
			}
		})
	}

	const handleUpdateValueSize = () => {
		document.querySelector("#sizesValue").value = JSON.stringify(arrSize);
	}


	const onRenderInputSize = () => {
		let content = "";
		for (let i = 0; i < arrSize.length; i++) {
			content += `
				<div>
					<label>Giá cộng thêm kích thước ${arrSize[i].name}</label>
					<input oninput="handleChangePrice(this,${arrSize[i].id})" data-id="${arrSize[i].name}" type="number" min="0" class="input width400 form-control" value="${arrSize[i].price}" />
				</div>
				`;
		}
		document.querySelector("#group__input__size").innerHTML = content;
		handleUpdateValueSize();
	}

	let arrSize = [];
	let sizeInputDefault = null;
	const fetchData = () => {
		let dataFromDB = '<?= $items[0]['size'] ?>';
		if (dataFromDB) {
			let res = JSON.parse(dataFromDB);
			arrSize = [...res];
			sizeInputDefault = arrSize.map(item => item.id);
			onRenderInputSize();
		}
		console.log(sizeInputDefault);
	}
	fetchData();
	const handleChangePrice = (e, id) => {
		const index = arrSize.findIndex(item => item.id == id);
		let value = "0";
		if (event.target.value) {
			value = event.target.value;
		}
		arrSize[index].price = value;
		handleUpdateValueSize();
	}




	$(document).ready(() => {

		// handle color 
		$('#colors').on('select2:select', function(e) {
			var data = e.params.data;
			console.log(data);
		});
		$('#colors').on('select2:unselect', function(e) {
			var data = e.params.data;
			console.log(data);
		});


		let colorDefault = '<?= $items[0]['color'] ?>';
		if (colorDefault) {
			$('#colors').val(colorDefault.split(","));
		}

		console.log(colorDefault)


		//handle size

		$('#sizes').on('select2:select', function(e) {
			let data = {
				id: e.params.data.id,
				price: 0,
				name: e.params.data.text
			};
			arrSize.push(data);
			onRenderInputSize();
		});


		$('#sizes').on('select2:unselect', function(e) {
			var data = e.params.data;
			const index = arrSize.findIndex(item => item.id == data.id);
			arrSize.splice(index, 1);
			onRenderInputSize();
			console.log(arrSize)
		});

		if (sizeInputDefault) {
			$('#sizes').val(sizeInputDefault);
		}
	})
</script>