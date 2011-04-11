class CreateClients < ActiveRecord::Migration
  def self.up
    create_table :clients do |t|
      t.string :cpf
      t.integer :cit_code
      t.string :name

      t.timestamps
    end
  end

  def self.down
    drop_table :clients
  end
end
