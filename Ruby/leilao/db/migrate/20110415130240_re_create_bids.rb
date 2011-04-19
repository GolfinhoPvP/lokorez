class ReCreateBids < ActiveRecord::Migration
	def self.up
		drop_table :bids

		create_table :bids do |t|
			t.integer :auction_id
			t.integer :client_id
			t.decimal :value

			t.timestamps
		end
	end

	def self.down
		create_table :bids do |t|
			t.integer :auction_id
			t.integer :client_id
			t.decimal :value

			t.timestamps
		end

		drop_table :bids
	end
end
