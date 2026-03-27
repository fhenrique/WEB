CREATE TABLE Estoque  (
	[Codigo] [int] IDENTITY NOT NULL,
	[Produto] [varchar](80) NULL,
	[Dt_Ent] [datetime] NULL,
	[Valor_Ent] [numeric](15,2) NULL,
	[Qtd_Ent] [int] NULL,
	[Dt_Saida][datetime] NULL,
	[Valor_Saida][varchar](60) NULL,
	[Qtd_Saida][varchar](300) NULL,
	[Liberado][varchar](25) NULL,
	[Porcent_Lucro][numeric](15,2) NULL,
	[Saldo][numeric](15,2) NULL,
	[Nome_Tecnico][varchar](100) NULL,
	[codMaterial][int] NULL
	CONSTRAINT pkEstoque PRIMARY KEY (Codigo)
) ON [PRIMARY]