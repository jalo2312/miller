const canvas = document.getElementById("signature-pad");
const clearButton = document.getElementById("clear-button");
const ctx = canvas.getContext("2d");

    const signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
        backgroundColor: 'rgba(255, 255, 255, 0)',
        penColor: 'rgb(0, 0, 0)',
        
        onEnd: () => {
            document.getElementById('clear-button1').disabled = false;
        }
    });

    

// Event listener for the clear button
function clearSignature1() {
    event.preventDefault();
    signaturePad.clear();
}

function exportToPdf() {
    event.preventDefault();
    const element = document.getElementById('content');
    const currentDate = new Date();
    const dateString = currentDate.toISOString().split('T')[0];
    const timeString = currentDate.toTimeString().split(' ')[0];
    const fileName = `Formulario_${dateString}_${timeString}.pdf`;
    const pdf = html2pdf().set({
        margin: 1,
        filename: fileName,
        image: { type: 'jpeg', quality: 1 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },
    });
    pdf.from(element).save();
    
}