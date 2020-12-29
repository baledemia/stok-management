<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <div class="heading">
      <h1 class="h3 mb-0 text-gray-800"><?=$title ?></h1>
    </div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Bunching</a></li>
      <li class="breadcrumb-item active">Submit</li>
    </ol>
  </div>

  <div class="row">
    <div class="col-sm-12">

      <div class="card">
        <div class="card-header border-bottom d-flex justify-content-between">
          <p><small>PT. SUKSES SETIA <br> 
          Jln. Kasir II No. 12 A Desa Pasir Jaya <br> 
          Jati Uwung - Tangerang</small></p>
          <div>
            <p><strong>No. Dokumen</strong> (FR.OP - 0308)</p>
            <h6><strong>Tanggal </strong> <br> 12 Juli 2020</h6>
          </div>
        </div>

        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <div class="row">
                <label for="no_order" class="col-sm-2 col-form-label">Nomor Order</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="no_order">
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <label for="no_ordercu" class="col-sm-2 col-form-label">Order CU</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="no_ordercu">
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <label for="no_orderpvc" class="col-sm-2 col-form-label">Order PVC</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="no_orderpvc">
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <label for="no_mesin" class="col-sm-2 col-form-label">No. Mesin</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="no_mesin">
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <div class="col-sm-2">Proses</div>
                <div class="col-sm-10">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="bunching">
                    <label class="form-check-label" for="bunching">
                      Bunching
                    </label>
                  </div>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <label for="jenis_ukuran" class="col-sm-2 col-form-label">Jenis / Ukuran</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="jenis_ukuran" value="Auto KTO (1x13 / 0.26)">
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <label for="panjang" class="col-sm-2 col-form-label">Panjang</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="panjang" value="64.000 MTR">
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <label for="warna" class="col-sm-2 col-form-label">Warna</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="warna">
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <label for="panjang_warna" class="col-sm-2 col-form-label">Panjang Per Warna</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="panjang_warna" value="2 Bobin x 12.000 M, 4 Bobin x 10.000 M">
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <label for="coilling" class="col-sm-2 col-form-label">Coilling</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="coilling">
                </div>
              </div>
            </li>
            
          </ul>
        </div>
        
      </div>
    </div>

    <div class="col-sm-12 mt-3">
      <div class="card">
        <div class="card-header border-bottom text-center text-uppercase">
          <h4 class="font-weight-bold">Diameter</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <h5 class="card-title">Filler</h5>
                  <h6 class="card-subtitle mb-2 text-muted">
                    <input type="text" name="" size="4" value=""> mm
                  </h6>
                  <a href="#" class="card-link">Nippel: <input type="text" name="" size="4" value=""> mm</a>
                  <a href="#" class="card-link">Dies: <input type="text" name="" size="4" value=""> mm</a>
                </li>
                <li class="list-group-item">
                  <h5 class="card-title">Sheating</h5>
                  <h6 class="card-subtitle mb-2 text-muted">
                    <input type="text" name="" size="4" value="10.4"> mm
                  </h6>
                  <a href="#" class="card-link">Nippel: <input type="text" name="" size="4" value="8.8"> mm</a>
                  <a href="#" class="card-link">Dies: <input type="text" name="" size="4" value="16.6"> mm</a>
                </li>
              </ul>
            </div>
            <div class="col-sm-6">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <h5 class="card-title">Bunch/Strd</h5>
                  <h6 class="card-subtitle mb-2 text-muted">
                    <input type="text" name="" size="4" value="10.4"> mm
                  </h6>
                  <a href="#" class="card-link">Dies: <input type="text" name="" size="4" value=""> mm</a>
                </li>
                <li class="list-group-item">
                  <h5 class="card-title">Isolasi</h5>
                  <h6 class="card-subtitle mb-2 text-muted">
                    <input type="text" name="" size="4" value=""> mm
                  </h6>
                  <a href="#" class="card-link">Nippel: <input type="text" name="" size="4" value=""> mm</a>
                  <a href="#" class="card-link">Dies: <input type="text" name="" size="4" value=""> mm</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-12 mt-3 mb-5">
      <div class="card">
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <div class="row">
                <label for="pemakaian_pvc" class="col-sm-2 col-form-label">Pemakaian PVC</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    
                    <input type="text" class="form-control" id="pemakaian_pvc">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Kg</div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <label for="jenis_pvc" class="col-sm-2 col-form-label">Jenis PVC</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="jenis_pvc">
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <label for="pemakaian_cu" class="col-sm-2 col-form-label">Pemakaian CU</label>
                <div class="col-sm-10">
                  
                  <div class="input-group">
                    
                    <input type="text" class="form-control" id="pemakaian_cu" value="394">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Kg</div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <label for="jumlah_ukuran" class="col-sm-2 col-form-label">Jumlah / Ukuran</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="jumlah_ukuran" value="13 / 0.26">
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <label for="printing" class="col-sm-2 col-form-label">Printing</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="printing">
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row">
                <label for="nama_operator" class="col-sm-2 col-form-label">Nama Operator</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nama_operator" value="SARDI">
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="form-group row">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Kirim SPK Buncher</button>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>