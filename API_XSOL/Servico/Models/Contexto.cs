using System;
using System.ComponentModel.DataAnnotations.Schema;
using System.Data.Entity;
using System.Linq;

namespace Servico.Models
{
    public partial class Contexto : DbContext
    {
        public Contexto()
            : base("name=Contexto")
        {
        }

        public virtual DbSet<USUARIOS> USUARIOS { get; set; }

        protected override void OnModelCreating(DbModelBuilder modelBuilder)
        {
            modelBuilder.Entity<USUARIOS>()
                .Property(e => e.CODIGO)
                .HasPrecision(3, 0);

            modelBuilder.Entity<USUARIOS>()
                .Property(e => e.NOME)
                .IsUnicode(false);

            modelBuilder.Entity<USUARIOS>()
                .Property(e => e.LOGIN)
                .IsUnicode(false);
        }
    }
}
