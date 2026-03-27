CREATE TABLE FornecedorEquipamento  (
	[Codigo] [int] IDENTITY NOT NULL,
	[Descricao] [varchar](160) NULL,
	[Valor] [numeric](15,2) NULL,
	[CodigoFornecedor] [int] NULL
	CONSTRAINT pkFornecedorEquipamento PRIMARY KEY (Codigo)
) ON [PRIMARY]