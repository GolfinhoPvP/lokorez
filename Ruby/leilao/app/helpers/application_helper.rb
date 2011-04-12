module ApplicationHelper
	def main_menu
		menu = %w(assembler auction car city client fuel model optional state)
		main_menu = "<ul>"
		menu.each do |iten|
			main_menu << "<li>" + link_to(iten, :controller => iten.pluralize) + "</li>"
		end
		main_menu << "</ul>"
		raw main_menu
	end
end
