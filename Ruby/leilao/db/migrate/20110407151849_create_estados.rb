class CreateEstados < ActiveRecord::Migration
  def self.up
    create_table :estados do |t|
      t.integer :est_codigo
      t.string :est_nome
      t.string :est_sigla

      t.timestamps
    end
    add_index(:estados, :est_codigo)
  end

  def self.down
    drop_table :estados
  end
end
