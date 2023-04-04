<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <!-- index.blade.php -->

    <div id="input-container">
        @foreach ($barang as $item)
            <div>
                <label for="input-{{ $item->id }}">Quantity for {{ $item->nama }} (Rp.{{ $item->price }}
                    each)</label>
                <input type="number" min="0" value="0" id="input-{{ $item->id }}" class="item-quantity"
                    data-price="{{ $item->price }}">
                <span class="item-price">Rp.{{ $item->price }}</span>
            </div>
        @endforeach
    </div>

    <textarea name="catatan" class="catatan" id="catatan" cols="30" rows="10"></textarea>
    <p>Total: Rp. <span id="total"></span></p>

    <button id="save-button">Save</button>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        const saveButton = document.getElementById('save-button');

        const inputs = document.querySelectorAll('.item-quantity');
        const prices = document.querySelectorAll('.item-price');
        const totalOutput = document.getElementById('total');

        function updateTotal() {
            let total = 0;
            inputs.forEach((input, index) => {
                const quantity = parseInt(input.value) || 0;
                const price = parseInt(prices[index].textContent.replace('Rp.', '')) || 0;
                total += quantity * price;
            });
            totalOutput.textContent = total;
        }

        inputs.forEach(input => {
            input.addEventListener('input', updateTotal);
        });

        // Update total on page load
        updateTotal();

        saveButton.addEventListener('click', function() {
            const items = {};
            inputs.forEach(input => {
                const id = input.id.replace('input-', '');
                const quantity = input.value;
                items[id] = quantity;
            });
            const catatan = document.getElementById('catatan').value; // get the value of the catatan field

            axios.post('{{ route('save-total') }}', {
                    items: items,
                    catatan: catatan // include the catatan field in the data payload

                })
                .then(response => {
                    alert('Total saved!');
                })
                .catch(error => {
                    alert('Error saving total!');
                });
        });
    </script>
</body>

</html>
