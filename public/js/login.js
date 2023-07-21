$(".input_text").focus(function(){
    $(this).prev('.fa').addclass('glowIcon')
})
$(".input_text").focusout(function(){
    $(this).prev('.fa').removeclass('glowIcon')
})

 // Skrip JavaScript untuk jam
 function updateClock() {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
    
    // Format waktu menjadi HH:MM:SS
    var timeString = hours.toString().padStart(2, '0') + ':' +
        minutes.toString().padStart(2, '0') + ':' +
        seconds.toString().padStart(2, '0');
    
    // Menampilkan waktu pada elemen dengan id "clock"
    document.getElementById('clock').textContent = timeString;

    
    // Memperbarui jam setiap detik
    setTimeout(updateClock, 1000);
    
}
function displayDate() {
    var currentDate = new Date();
    var year = currentDate.getFullYear();
    var month = currentDate.getMonth() + 1;
    var day = currentDate.getDate();
    var dateString = day + '-' + month + '-' + year;
    document.getElementById('date').textContent = dateString;
}

// Memanggil fungsi updateClock saat halaman dimuat
window.onload = function () {
    updateClock();
    displayDate();
};