class CreateCidades < ActiveRecord::Migration
  def self.up
    create_table :cidades do |t|
      t.integer :cid_codigo
      t.integer :est_codigo
      t.string :cid_nome

      t.timestamps
    end
    add_index(:cidades, :cid_codigo)
    add_index(:cidades, :est_codigo)
  end

  def self.down
    drop_table :cidades
  end
end
