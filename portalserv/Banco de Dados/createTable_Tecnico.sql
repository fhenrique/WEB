CREATE TABLE Tecnico  (
	[Codigo] [int] IDENTITY NOT NULL,
	[Nome][varchar](80) NULL,
	[Dt_Nasc][datetime] NULL,
	[RG][varchar](255) NULL,
	[CPF][varchar](255) NULL,
	[Aux_Tecnico][varchar](255) NULL,
	[Aux_Tecnico_RG][varchar](255) NULL,
	[Aux_Tecnico_CPF][varchar](255) NULL,
	[RAZAO][varchar](80) NULL,
	[End][varchar](80) NULL,
	[Bairro][varchar](80) NULL,
	[Cep][varchar](20) NULL,
	[Cidade][varchar](60) NULL,
	[CNPJ][varchar](30) NULL,
	[Fone][varchar](50) NULL,
	[Celular][varchar](255) NULL,
	[Status][varchar](1) NULL,
	[DiasNaoDisponivel][varchar](255) NULL,
	[MesNaoDisponivel][varchar](3) NULL
	CONSTRAINT pkTecnico PRIMARY KEY (Codigo)
) ON [PRIMARY]