CREATE TABLE Endereco  (
	[Codigo] [int] IDENTITY NOT NULL,
	[Cod_Cliente] [int] NULL,
	[Endereco] [varchar](300) NULL,
	[Bairro] [varchar](300) NULL,
	[Cidade] [varchar](300) NULL,
	[UF] [varchar](255) NULL,
	[CEP] [varchar](255) NULL,
	[Ref] [varchar](255) NULL,
	[Zona] [varchar](255) NULL
) ON [PRIMARY]