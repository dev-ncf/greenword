<div id="modal"
    style="width: 100%; height:100%; top: 0; left:0; background-color: #00000030; display: none; position: fixed; z-index: 100; justify-content: center; align-items: center;">
    <div style="background-color: white; padding:40px; box-shadow: 1px 5px 10px white; border-radius: 10px">
        {{-- <input type="text" id="student-code"> --}}
        <h3>Queres mesmo apagar?</h3>
        <form action="#" id="form-delete" method="POST">
            @csrf
            @method('DELETE')
            <div style="display: flex; justify-content: space-between; margin-top:20px">
                <button type="button" id="confirm-delete" class="btn"
                    style="background-color: #7380ec; padding:4px 8px; color:white;border-radius: 5px">Confirmar</button>
                <button class="btn" type="button"
                    style="background-color: #ff7782; padding:4px 8px; color:white;border-radius: 5px"
                    onclick="closeModal()">Cancelar</button>
            </div>
        </form>
    </div>
</div>
<script>
    function confirmDeletion(event) {
        event.preventDefault(); // Previne o comportamento padrão do link

        // Exibe o modal
        document.getElementById('modal').style.display = 'flex';

        // Obtém o código do estudante a partir do botão clicado
        var dado = event.currentTarget.getAttribute('dado');
        var rota = event.currentTarget.getAttribute('rota');
        var confirmLink = document.getElementById('confirm-delete');
        var formDelete = document.getElementById('form-delete');
        confirmLink.addEventListener('click', () => {
            formDelete.action = `{{ url('/') }}/${rota}/${dado}`;
            formDelete.submit();
            closeModal()
        })

        // confirmLink.href = `{{ url('/') }}/${rota}/${dado}`;

        // Define o código no campo do modal
        //   document.getElementById('student-code').value = dado;

    }

    function closeModal() {
        document.getElementById('modal').style.display = 'none';
    }
</script>
