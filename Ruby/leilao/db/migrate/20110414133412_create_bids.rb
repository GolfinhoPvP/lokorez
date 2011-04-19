class CreateBids < ActiveRecord::Migration
  def self.up
    create_table :bids, :id => false do |t|
      t.integer :auction_id
      t.integer :client_id
      t.decimal :value

      t.timestamps
    end
  end

  def self.down
    drop_table :bids
  end
end
