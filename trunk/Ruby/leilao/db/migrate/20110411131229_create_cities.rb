class CreateCities < ActiveRecord::Migration
  def self.up
    create_table :cities do |t|
      t.integer :est_code
      t.string :name

      t.timestamps
    end
    add_index :cities, :est_code
  end

  def self.down
    drop_table :cities
  end
end
