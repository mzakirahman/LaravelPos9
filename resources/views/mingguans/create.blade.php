@extends('layout.main')

@section('judul')
    From Tambah Media Cetak Mingguan
@endsection

@section('isi')
    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-body px-0 pt-0 pb-2">
                    <form action="{{ route('mingguans.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="wartawan_id">Dikirim kewartawan</label>
                            <select class="form-control" id="wartawan_id" name="wartawan_id">
                                @foreach($wartawans as $wartawan)
                                    <option value="{{ $wartawan->id }}">{{ $wartawan->username }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama_media" class="form-label">Nama Media</label>
                            <input type="text" name="nama_media" class="form-control" id="nama_media" aria-describedby="emailHelp">
                        </div>          
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jenis Media</label>
                            <input type="text" name="jenis_media" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jenis Pesanan</label>
                            <input type="text" name="jenis_pesanan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jumlah Pesanan</label>
                            <input type="text" name="jumlah_pesanan" class="form-control" id="jumlah_pesanan" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Satuan</label>
                            <input type="text" name="satuan" class="form-control" id="satuan" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Harga</label>
                            <input type="text" name="harga" class="form-control" id="harga" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Total Transfer</label>
                            <input type="text" name="total_transfer" class="form-control" id="total_transfer" aria-describedby="emailHelp" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jumlah</label>
                            <input type="text" name="jumlah" class="form-control" id="jumlah" aria-describedby="emailHelp" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pajak (%)</label>
                            <input type="text" name="pajak" class="form-control" id="pajak" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tanggal</label>
                            <input type="date" name="bulan" class="form-control" id="bulan" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="lampiran">Lampiran:</label>
                            <input type="file" class="form-control-file" name="lampiran" id="lampiran">
                        </div>
                        
                        <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                    </form>
                <!-- JavaScript -->
                <script>
                    // Function untuk menghitung harga berdasarkan jumlah pesanan dan satuan
                    function calculateHarga() {
                        const jumlahPesanan = parseFloat(document.getElementById('jumlah_pesanan').value);
                        const satuan = parseFloat(document.getElementById('satuan').value);

                        // Hitung harga
                        const harga = jumlahPesanan * satuan;
                        document.getElementById('harga').value = harga;
                    }

                    // Function untuk menghitung total transfer dan jumlah setelah dipotong dengan pajak
                    function calculateTotalTransferAndJumlah() {
                        const pajak = parseFloat(document.getElementById('pajak').value);
                        const harga = parseFloat(document.getElementById('harga').value);

                        // Hitung total transfer
                        const totalTransfer = harga - (harga * pajak / 100);
                        document.getElementById('total_transfer').value = totalTransfer;

                        // Hitung jumlah setelah dipotong pajak
                        const jumlahSetelahPajak = harga - (harga * pajak / 100);
                        document.getElementById('jumlah').value = jumlahSetelahPajak;
                    }

                    // Panggil fungsi calculateHarga dan calculateTotalTransferAndJumlah setiap kali nilai input berubah
                    document.getElementById('jumlah_pesanan').addEventListener('input', calculateHarga);
                    document.getElementById('satuan').addEventListener('input', calculateHarga);
                    document.getElementById('pajak').addEventListener('input', calculateTotalTransferAndJumlah);
                </script>
                </div>
            </div>
        </div>
    </div>
@endsection