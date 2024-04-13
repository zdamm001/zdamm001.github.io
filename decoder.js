function decodeBase64() {
    let base64Input = document.getElementById("base64Input").value.trim();

    if (base64Input === "") {
        alert("Please enter base64 encoded data.");
        return;
    }

    let decodedData;
    try {
        decodedData = atob(base64Input);
    } catch (error) {
        alert("Invalid base64 encoded data.");
        return;
    }

    let decompressedData;
    try {
        let byteArray = Uint8Array.from(decodedData, c => c.charCodeAt(0));
        decompressedData = pako.inflate(byteArray, { to: 'string' });
    } catch (error) {
        alert("Failed to decompress data.");
        return;
    }

    let replacedData = decompressedData
        .replace(/\x00/g, 'N.')
        .replace(/\x01/g, 'J.')
        .replace(/\x02/g, 'L.')
        .replace(/\x03/g, 'LJ.')
        .replace(/\x04/g, 'R.')
        .replace(/\x05/g, 'RJ.')
        .replace(/\x06/g, 'LR.')
        .replace(/\x07/g, 'LRJ.');

    document.getElementById("decodedOutput").textContent = replacedData;
}
