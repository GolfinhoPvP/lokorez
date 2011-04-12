class CreateOptionals < ActiveRecord::Migration
  def self.up
    create_table :optionals do |t|
      t.string :name

      t.timestamps
    end
  end

  def self.down
    drop_table :optionals
  end
end
