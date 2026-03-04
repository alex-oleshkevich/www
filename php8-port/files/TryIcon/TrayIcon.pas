unit TrayIcon;

interface

uses
  Windows, Messages, SysUtils, Classes, Graphics, Controls, Forms, Dialogs, ShellAPI, Menus;

const
  Wm_Callback_Message = Wm_User + 1;

type
  TTrayIcon = class(TComponent)
  private
    TTrayIconData: TNotifyIconData;
    TTrayIconca: TIcon;
    TTrayHint: string;
    TTrayIconVisible: boolean;
    TTrayShowMin: boolean;
    TTrayPopup: TPopupMenu;
  protected
    procedure AppMinimize(Sender: TObject);
    procedure ProcessInput (var Msg: TMessage); virtual;
    procedure SetVisible (NewValue: boolean);
    procedure SetHint (NewValue: string);
    procedure SetIcon (NewValue: TIcon);
    procedure IconChanged(Sender: TObject);
    function StoreIcon: Boolean;
    procedure Modify;
    procedure ShowPopupMenu;
  public
   constructor Create(TheOwner:TComponent); override;
   destructor Destroy; override;
   procedure Show;
   procedure Hide;
  published
   property Visible: boolean read TTrayIconVisible write SetVisible default false;
   property ActOnMinimize: boolean read TTrayShowMin write TTrayShowMin;
   property Hint: string read TTrayHint write SetHint;
   property Icon: TIcon read TTrayIconca write SetIcon stored StoreIcon;
   property PopupMenu: TPopupMenu read TTrayPopup write TTrayPopup;
  end;

procedure Register;

implementation

constructor TTrayIcon.Create(TheOwner:TComponent);
begin
  inherited Create(TheOwner);
  TTrayHint:=Application.Title;
  TTrayIconVisible:=False;
  TTrayIconca:=TIcon.Create;
  TTrayIconData.Wnd:=AllocateHwnd(ProcessInput);
  TTrayIconData.cbSize:=SizeOf(TTrayIconData);
  TTrayIconData.uID:=0;
  TTrayIconData.uFlags:=NIF_ICON or NIF_TIP or NIF_MESSAGE;
  TTrayIconData.uCallBackMessage:=Wm_Callback_Message;
  Self.TTrayIconca.OnChange:=Self.IconChanged;
  TTrayPopup:=nil;
  Application.OnMinimize:=AppMinimize;
 end;

destructor TTrayIcon.Destroy;
begin
 Self.Hide;
 DeallocateHWnd(TTrayIconData.Wnd);
 Self.TTrayIconca.Free;
 inherited Destroy;
end;

procedure TTrayIcon.ShowPopupMenu;
var MousePos: TPoint;
begin
 if (Self.PopupMenu <> nil) then begin
  GetCursorPos(MousePos);
  TTrayPopup.Alignment := paLeft;
  SetForegroundWindow(TTrayIconData.Wnd);
  TTrayPopup.Popup(MousePos.X, MousePos.Y - (GetSystemMetrics(SM_CYMENUSIZE) * TTrayPopup.Items.Count));
  PostMessage(TTrayIconData.Wnd, WM_NULL, 0, 0);
 end;
end;

procedure TTrayIcon.AppMinimize(Sender: TObject);
begin
 if TTrayShowMin=true and TTrayIconVisible=false then Self.Show;
end;

procedure TTrayIcon.IconChanged(Sender: TObject);
begin
 Self.Modify;
end;

procedure TTrayIcon.SetHint (NewValue: string);
begin
 if NewValue <> TTrayHint then begin
  TTrayHint:=NewValue;
  Self.Modify;
 end;
end;

function TTrayIcon.StoreIcon: Boolean;
begin
  Result := (not Self.TTrayIconca.Empty);
end;

procedure TTrayIcon.SetIcon (NewValue: TIcon);
begin
 Self.TTrayIconca.Assign(NewValue);
end;

procedure TTrayIcon.SetVisible (NewValue: boolean);
begin
 if NewValue <> TTrayIconVisible then begin
  if NewValue = false then Self.Hide
  else
  Self.Show;
 end;
end;

procedure TTrayIcon.Modify;
begin
  TTrayIconData.hIcon:=TTrayIconca.Handle;
  StrPLCopy(TTrayIconData.szTip, TTrayHint, SizeOf(TTrayIconData.szTip)-1);
  if TTrayIconVisible=true then Shell_NotifyIcon(NIM_MODIFY, @TTrayIconData);
end;

procedure TTrayIcon.Show;
begin
  TTrayIconData.hIcon:=TTrayIconca.Handle;
  StrPLCopy(TTrayIconData.szTip, TTrayHint, SizeOf(TTrayIconData.szTip)-1);
  Shell_NotifyIcon(NIM_ADD, @TTrayIconData);
  TTrayIconVisible:=true;
  Application.Minimize;
  ShowWindow(Application.Handle,SW_HIDE);
end;

procedure TTrayIcon.Hide;
begin
  Shell_NotifyIcon(NIM_DELETE, @TTrayIconData);
  ShowWindow(Application.Handle,SW_SHOW);
  Application.Restore;
  TTrayIconVisible:=false;
end;

procedure TTrayIcon.ProcessInput (var Msg: TMessage);
begin
  if Msg.Msg = Wm_Callback_Message then begin
   case (Msg.lParam) of
{      WM_LBUTTONDBLCLK: Self.DoubleClick(mbLeft);
      WM_MBUTTONDBLCLK: Self.DoubleClick(mbMiddle);
      WM_RBUTTONDBLCLK: Self.DoubleClick(mbRight);
}
      WM_LBUTTONDOWN:   Self.Hide;
{      WM_MBUTTONDOWN:   Self.MouseDown(mbMiddle);}
      WM_RBUTTONDOWN:   Self.ShowPopupMenu;

{      WM_LBUTTONUP:     Self.MouseUp(mbLeft);
      WM_MBUTTONUP:     Self.MouseUp(mbMiddle);
      WM_RBUTTONUP:     Self.MouseUp(mbRight);

      WM_MOUSEMOVE:     Self.MouseMove;}
   end;
  end
  else begin
   Msg.Result := DefWindowProc(TTrayIconData.Wnd, Msg.Msg, Msg.wParam, Msg.lParam);
  end;
end;

procedure Register;
begin
  RegisterComponents('Standard', [TTrayIcon]);
end;

end.
