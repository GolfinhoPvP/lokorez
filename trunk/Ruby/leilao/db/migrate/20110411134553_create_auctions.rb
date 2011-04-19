class CreateAuctions < ActiveRecord::Migration
  def self.up
    create_table :auctions do |t|
      t.integer :car_code
      t.datetime :auction_start
      t.decimal :initial_value
      t.decimal :buy_now_value
      t.decimal :capping_value
      t.boolean :status

      t.timestamps
    end
    add_index :auctions, :car_code
  end

  def self.down
    drop_table :auctions
  end
end
