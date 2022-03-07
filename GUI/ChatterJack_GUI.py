import wx
import text_to_speech
from coreEngine import coredata, search_controls


def SendCurrQuestion(curr_question):
    return search_controls.getAnswer(curr_question)


class ChatterJackFrame(wx.Frame):
    """ This is a class for setting the parameters of where and
    what the widgets will be doing on the main window"""

    def __init__(self, parent_app, title):
        wx.Frame.__init__(self, parent_app, -1, title,
                          pos=(0, 0), size=(wx.DisplaySize()))

        # Create the Panel to put the widgets on.
        panel = wx.Panel(self)
        # Creates a grid sizer with 2 rows and 2 columns
        grid_sizer = wx.GridSizer(2, 2, 5, 5)
        # Sets a base line for text font
        self.font = wx.Font(20, family=wx.FONTFAMILY_MODERN, style=0, weight=90,
                            underline=False, faceName="", encoding=wx.FONTENCODING_DEFAULT)
        # A text line that the ChatBot will be using to reply (closed captions)
        self.bot_txt = wx.StaticText(panel, -1, coredata.startMess)
        # adds bot_txt to grid_sizer
        grid_sizer.Add(self.bot_txt, 0, flag=wx.ALIGN_RIGHT)
        # below line used to appropriately size the text equal to the size of the window
        self.bot_txt.Wrap(wx.DisplaySize()[1]/3.3)
        # coredata.startMess is a predefined start phrase inside coredata
        self.bot_txt.SetFont(self.font)
        # line below is used as a filler box to be replaced with robot face in the future
        grid_sizer.Add(wx.StaticText(panel, label=""), 0, flag=wx.EXPAND)
        # A text box for the user to input their question into, sets size to 2/3 of the screen size.
        self.txt_box = wx.TextCtrl(panel, -1, "Ask Your Question Here...", size=((wx.DisplaySize()[1]/1.5), -1))
        # add the txt_box to the grid_sizer
        grid_sizer.Add(self.txt_box, 100, flag=wx.ALIGN_CENTER_VERTICAL | wx.ALIGN_RIGHT)
        # Button for user to click when answer is properly inserted in the txt_box
        sub_btn = wx.Button(panel, -1, "Submit")
        # add sub_btn to grid_sizer
        grid_sizer.Add(sub_btn, 0, wx.ALIGN_CENTER_VERTICAL)
        # bind the button event to it's handler function
        self.Bind(wx.EVT_BUTTON, self.OnTimeToSubmit, sub_btn)
        panel.SetSizer(grid_sizer)

    def OnTimeToSubmit(self, evt):
        """Event handler for the Submit button click."""
        return_str = SendCurrQuestion(self.txt_box.GetValue())
        # return answer as test-to-speech and a closed caption
        self.bot_txt.SetLabelText(return_str)
        text_to_speech.return_str_as_speech(return_str)


class ChatterJack(wx.App):
    def OnInit(self):
        frame = ChatterJackFrame(None, "ChatterJack ChatBot")
        self.SetTopWindow(frame)
        frame.Show(True)
        return True


app = ChatterJack(redirect=True)
app.MainLoop()
