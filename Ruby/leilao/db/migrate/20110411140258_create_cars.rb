class CreateCars < ActiveRecord::Migration
  def self.up
    create_table :cars do |t|
      t.integer :mod_code
      t.string :engine
      t.string :plate
      t.string :colour
      t.integer :mileage
      t.integer :manufacture_year
      t.integer :model_year
      t.text :comments

      t.timestamps
    end
  end

  def self.down
    drop_table :cars
  end
end
