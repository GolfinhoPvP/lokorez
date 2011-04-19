class AddAssCodeToModels < ActiveRecord::Migration
	def self.up
		add_column :models, :ass_code, :integer
	end

	def self.down
		remove_column :models, :ass_code
	end
end
