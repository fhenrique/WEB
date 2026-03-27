CREATE TABLE Fornecedor  (
	[Codigo] [int] IDENTITY NOT NULL,
	[NomeCli] [varchar](80) NULL,
	[End] [varchar](80) NULL,
	[Bairro] [varchar](80) NULL,
	[Cidade] [varchar](50) NULL,
	[Cep][varchar](20) NULL,
	[CNPJ][varchar](30) NULL,
	[Fone][varchar](50) NULL,
	[Fax][varchar](50) NULL,
	[Contato][varchar](30) NULL,
	[Tipo_Mat][varchar](500) NULL,
	[Email][varchar](150) NULL
	CONSTRAINT pkFornecedor PRIMARY KEY (Codigo)
) ON [PRIMARY]