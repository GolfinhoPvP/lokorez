class CreateClientes < ActiveRecord::Migration
  def self.up
    create_table :clientes do |t|
      t.string :cli_cpf
      t.integer :cid_codigo
      t.integer :est_codigo
      t.string :cli_nome

      t.timestamps
    end
    add_index(:clientes, :cli_cpf)
    add_index(:clientes, :cid_codigo)
    add_index(:clientes, :est_codigo)
  end

  def self.down
    drop_table :clientes
  end
end
