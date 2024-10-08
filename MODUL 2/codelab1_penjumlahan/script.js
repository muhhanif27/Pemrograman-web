function hitung() {
    let num1 = parseFloat(document.getElementById('num1').value);
    let num2 = parseFloat(document.getElementById('num2').value);
    let hasil = num1 + num2;

    document.getElementById('result').innerHTML = 'Hasil: ' + hasil;
}

function reset() {
    document.getElementById('num1').value = '';
    document.getElementById('num2').value = '';
    document.getElementById('result').innerHTML = 'Hasil: ';
}
