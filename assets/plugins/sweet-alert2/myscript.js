const flashDataSukses = $('.flash-data-sukses').data('flashdatasukses');

if (flashDataSukses) {
    Swal.fire({
        position: 'center',
        title: 'Data',
        text: 'Berhasil ' + flashDataSukses,
        icon: 'success',
        timer: 2200,
        showConfirmButton: false
    });
}

const flashDataGagal = $('.flash-data-gagal').data('flashdatagagal');

if (flashDataGagal) {
    Swal.fire({
        position: 'center',
        title: 'Data',
        text: 'Gagal ' + flashDataGagal,
        icon: 'error',
        timer: 2200,
        showConfirmButton: false
    });
}

const flashDataAda = $('.flash-data-ada').data('flashdataada');

if (flashDataAda) {
	Swal.fire({
        position: 'center',
		title: 'Data',
		text: 'Sudah ' + flashDataAda,
        icon: 'error',
        timer: 2200,
        showConfirmButton: false
	});
}

const flashDataLogin = $('.flash-data-login').data('flashdatalogin');

if (flashDataLogin) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true
    });

    Toast.fire({
    	icon: 'success',
    	title: 'Login anda berhasil'
    });
}

const flashDataMasuk = $('.flash-data-masuk').data('flashdatamasuk');

if (flashDataMasuk) {
	Swal.fire({
		position: 'center',
		title: 'Pemilih',
		text: 'Tidak ' + flashDataMasuk,
		icon: 'error',
		timer: 2000,
		showConfirmButton: false
	});
}

//Tombol Hapus
$('.tombol-hapus').on('click', function(e){
    //untuk mematikan href
    e.preventDefault();
    const href = $(this).attr('href');
    //jalankan alert
    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: 'data akan dihapus',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
});

//Tombol Nonpeng
$('.tombol-non').on('click', function(e){
    //untuk mematikan href
    e.preventDefault();
    const href = $(this).attr('href');
    //jalankan alert
    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: 'Pengguna akan di nonaktifkan',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Nonaktifkan'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
});

//Tombol sudah
$('.tombol-sudah').on('click', function (e) {
    //untuk mematikan href
    e.preventDefault();
    const href = $(this).attr('href');
    //jalankan alert
    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: 'Pemilih belum memilih',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
});


