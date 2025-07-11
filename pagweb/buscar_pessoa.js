function buscarPessoa() {
    const cpf = document.getElementById('cpf').value;

    if (cpf.length < 11) {
        alert('CPF inválido!');
        return;
    }

    fetch('buscar_pessoa.php?cpf=' + encodeURIComponent(cpf))
        .then(response => response.json())
        .then(data => {
            if (data.sucesso) {
                document.getElementById('endereco').value = data.endereco;
                document.getElementById('cargo').value = data.cargo;
                document.getElementById('funcao').value = data.funcao;
            } else {
                alert('Pessoa não encontrada!');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao buscar pessoa.');
        });
}
