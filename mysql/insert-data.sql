INSERT INTO Usuario (
    nome,
    sobrenome,
    email,
    senha,
    telefone,
    rua,
    numero,
    cep,
    cidade,
    estado,
    sexo
)
VALUES
    (
		'Ricardo',
		'Fagundes',
		'ricardo.fagundes@gmail.com',
		'password',
		'33443344',
		'Rua Joao Abraao',
		'12-43',
		'1789773',
		'Bauru',
		'SP',
		'M'
    ),
    (
		'Joana',
		'Fagundes',
		'joana.fagundes@gmail.com',
		'password',
		'3334355',
		'Rua Nunes Peixoto',
		'19-78',
		'1789341',
		'Agudos',
		'SP',
		'F'
    ),
      (
		'Kleber',
		'James',
		'kleber.james@gmail.com',
		'password',
		'3378394',
		'Rua Augustinho Carrara',
		'45-78',
		'129072',
		'Jaboticabal',
		'SP',
		'M'
    ),
          (
		'Lucas',
		'Cegiel',
		'cegiel.james@gmail.com',
		'password',
		'3234098',
		'Rua Nacoes Norte',
		'55-34',
		'129345',
		'Bauru',
		'SP',
		'M'
    );


INSERT INTO Personal (
    id_usuario,
    especializacao,
    tempo_experiencia
)
VALUES
    (
		'1',
		'Aerobica',
		'7 anos'
    ),
    (
		'2',
		'Musculacao',
		'3 anos'
    );

INSERT INTO Aluno (
    id_usuario,
    objetivo,
    peso,
    altura,
    med_braco_direito,
    med_braco_esquerdo,
    med_perna_direita,
    med_perna_esquerda,
    med_peito,
    med_abdomen


)
VALUES
    (
		'3',
		'Ganho de peso',
		'63 kg',
        '1.70 m', 
        '20 cm',
        '22 cm',
        '30 cm',
        '28 cm',
        '50 cm',
        '58 cm'
    ),
    (
		'4',
		'Ficar forte',
		'70 kg',
        '1.60 m',
        '30 cm',
        '27 cm',
        '33 cm',
        '35 cm',    
        '60 cm',
        '53 cm'
        );

INSERT INTO Academia (
    nome,
    rua,
    numero,
    cidade,
    estado,
    cep,
    telefone,
    email,
    horario_abre,
    horario_fecha


)
VALUES
    (
		'Four Gym 3',
		'Rua Angelo Amarao',
		'7-56',
        'Jaboticabal', 
        'SP',
        '12304843',
        '99882772',
        'fourgyma@email.com',
        '7 AM',
        '23 PM'
    ),
    (
		'New Journey Academy',
		'Rua dos Condenados',
		'6-66',
        'Jahu',
        'SP',
        '16434834',
        '34569607',
        'njourney@gmail.com',    
        '5 AM',
        '1 AM'
        );

INSERT INTO Aparelhos (
    nome,
    musculo,
    identificacao

)
VALUES
    (
		'Supino',
		'Peito',
		'1A'
    ),
    (
		'Peso 15 kg',
		'Biceps/Triceps',
		'3T'
    ),
    (
		'Adutor',
		'Pernas',
		'6R'
    ),
    (
		'Peso 20 kg',
		'Biceps/Triceps',
		'4T'
    );

INSERT INTO Exercicio (
    nome,
    series,
    repeticoes,
    descanso,
    maquina

)
VALUES
    (
		'Supino Reto',
		'4',
		'5',
        '10',
        '1'

    ),
    (
		'Supino Inclinado',
		'2',
		'3',
        '15',
        '1'
    ),
    (
		'Adutor',
		'4',
		'5',
        '15',
        '3'
    );

I


INSERT INTO Treino (
    id_exercicio,
    dia,
    ordem,
    id_aluno
)

VALUES
    (
		'1',
		'03/07/2020',
		'2',
        '1'
    ),
    (
		'3',
		'05/07/2020',
		'3',
        '1'
    ),
    (
		'3',
		'29/06/2020',
		'2',
        '2'
    );

INSERT INTO Agendamento (
    id_aluno,
    id_personal,
    id_academia,
    dia,
    hora
)

VALUES
    (
		'2',
		'2',
		'2',
        '10/09/2020',
        '7 PM'
    );

