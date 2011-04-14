class CreateConcessionaires < ActiveRecord::Migration
  def self.up
    create_table :concessionaires do |t|
      t.string :name

      t.timestamps
    end
  end

  def self.down
    drop_table :concessionaires
  end
end
