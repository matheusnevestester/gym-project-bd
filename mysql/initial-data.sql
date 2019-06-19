

CREATE DATABASE gymdb;
USE gymdb;
-- -----------------------------------------------------
-- Table `gymdb`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymdb`.`Usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `sobrenome` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `senha` VARCHAR(45) NULL,
  `telefone` VARCHAR(45) NULL,
  `rua` VARCHAR(45) NULL,
  `numero` VARCHAR(45) NULL,
  `cep` VARCHAR(45) NULL,
  `cidade` VARCHAR(45) NULL,
  `estado` VARCHAR(45) NULL,
  `sexo` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gymdb`.`Personal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymdb`.`Personal` (
  `id` INT NOT NULL auto_increment,
  `id_usuario` INT NULL,
  `especializacao` VARCHAR(45) NULL,
  `tempo_experiencia` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Personal_Usuario_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_Personal_Usuario`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `gymdb`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gymdb`.`Aluno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymdb`.`Aluno` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NULL,
  `objetivo` VARCHAR(45) NULL,
  `peso` VARCHAR(45) NULL,
  `altura` VARCHAR(45) NULL,
  `med_braco_direito` VARCHAR(45) NULL,
  `med_braco_esquerdo` VARCHAR(45) NULL,
  `med_perna_direita` VARCHAR(45) NULL,
  `med_perna_esquerda` VARCHAR(45) NULL,
  `med_peito` VARCHAR(45) NULL,
  `med_abdomen` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Aluno_Usuario_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_Aluno_Usuario`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `gymdb`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gymdb`.`Academia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymdb`.`Academia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `rua` VARCHAR(45) NULL,
  `numero` VARCHAR(45) NULL,
  `cidade` VARCHAR(45) NULL,
  `estado` VARCHAR(45) NULL,
  `cep` VARCHAR(45) NULL,
  `telefone` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `seg_inicio` VARCHAR(45) NULL,
  `seg_fim` VARCHAR(45) NULL,
  `ter_inicio` VARCHAR(45) NULL,
  `ter_fim` VARCHAR(45) NULL,
  `qua_inicio` VARCHAR(45) NULL,
  `qua_fim` VARCHAR(45) NULL,
  `qui_inicio` VARCHAR(45) NULL,
  `qui_fim` VARCHAR(45) NULL,
  `sex_inicio` VARCHAR(45) NULL,
  `sex_fim` VARCHAR(45) NULL,
  `sab_inicio` VARCHAR(45) NULL,
  `sab_fim` VARCHAR(45) NULL,
  `dom_inicio` VARCHAR(45) NULL,
  `dom_fim` VARCHAR(45) NULL,
  `feriado_inicio` VARCHAR(45) NULL,
  `feriado_fim` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gymdb`.`Aparelho`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymdb`.`Aparelho` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `musculo` VARCHAR(45) NULL,
  `identificacao` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gymdb`.`Exercício`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymdb`.`Exercicio` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `series` INT NULL,
  `repeticoes` INT NULL,
  `descanso` INT NULL,
  `maquina` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Exercicio_Aparelho_idx` (`maquina` ASC),
  CONSTRAINT `fk_Exercicio_Aparelho`
    FOREIGN KEY (`maquina`)
    REFERENCES `gymdb`.`Aparelho` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `gymdb`.`Treino`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymdb`.`Treino` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_exercicio` INT NULL,
  `dia` VARCHAR(45) NULL,
  `ordem` INT NULL,
  `id_aluno` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Treino_Exercicio_idx` (`id_exercicio` ASC),
  INDEX `fk_Treino_Aluno_idx` (`id_aluno` ASC),
  CONSTRAINT `fk_Treino_Exercicio`
    FOREIGN KEY (`id_exercicio`)
    REFERENCES `gymdb`.`Exercicio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Treino_Aluno`
    FOREIGN KEY (`id_aluno`)
    REFERENCES `gymdb`.`Aluno` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gymdb`.`Agendamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymdb`.`Agendamento` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_aluno` INT NOT NULL,
  `id_personal` INT NOT NULL,
  `id_academia` INT NOT NULL,
  `dia` VARCHAR(45) NOT NULL,
  `hora` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`,`id_aluno`,`id_personal`,`id_academia`,`dia`,`hora`),
  INDEX `fk_Agendamento_Aluno_idx` (`id_aluno` ASC),
  INDEX `fk_Agendamento_Personal_idx` (`id_personal` ASC),
  INDEX `fk_Agendamento_Academia_idx` (`id_academia` ASC),
  CONSTRAINT `fk_Agendamento_Aluno`
    FOREIGN KEY (`id_aluno`)
    REFERENCES `gymdb`.`Aluno` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Agendamento_Personal`
    FOREIGN KEY (`id_personal`)
    REFERENCES `gymdb`.`Personal` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Agendamento_Academia`
    FOREIGN KEY (`id_academia`)
    REFERENCES `gymdb`.`Academia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;