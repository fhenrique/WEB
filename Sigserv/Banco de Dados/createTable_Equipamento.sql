CREATE TABLE Equipamento  (
	[Codigo] [int] IDENTITY NOT NULL,
	[Cod_Cliente] [int] NULL,
	[Equipamento] [varchar](300) NULL,
	[Cod_Endereco] [varchar](300) NULL,
	[ExibeNaFicha] [varchar](1) NULL
	CONSTRAINT pkEquipamento PRIMARY KEY (Codigo)
) ON [PRIMARY]