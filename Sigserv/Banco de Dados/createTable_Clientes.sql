CREATE TABLE Clientes(
	[Codigo] [int] IDENTITY NOT NULL,
	[Data_Emissao] [datetime] NULL,
	[Nome_Cli][varchar](100) NULL,
	[Fone_Celular][varchar](30) NULL,
	[Fone_Res][varchar](30) NULL,
	[Fone_Com][varchar](30) NULL,
	[CPF][varchar](30) NULL,
	[CNPJ][varchar](30) NULL,
	[Atendente][varchar](30) NULL,
	[E_Mail][varchar](80) NULL,
	[Solicitante][varchar](100) NULL,
	[Contrato][varchar](30) NULL,
	[Dt_Contrato][datetime] NULL,
	[Aquivo_Morto][varchar](1) NULL,
	[Aquivo_Morto_Justificativa][varchar](255) NULL	
	CONSTRAINT pkClientes PRIMARY KEY (Codigo)
) ON [PRIMARY]