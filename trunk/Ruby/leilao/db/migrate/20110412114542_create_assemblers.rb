class CreateAssemblers < ActiveRecord::Migration
  def self.up
    create_table :assemblers do |t|
      t.string :name

      t.timestamps
    end
  end

  def self.down
    drop_table :assemblers
  end
end
