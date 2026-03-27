CREATE TABLE MaterialFornecedor  (
	[Codigo] [int] IDENTITY NOT NULL,
	[CodMaterial] [int] NULL,
	[CodFornecedor] [int] NULL,
	[ValorCompra] [numeric](15,2) NULL,
	[PorcentagemLucro] [numeric](15,2) NULL,
	[ValorVenda] [numeric](15,2) NULL,
) ON [PRIMARY]