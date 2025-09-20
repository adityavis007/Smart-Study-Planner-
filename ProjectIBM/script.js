
(() => {
  const KEY = 'study_planner_tasks_v1';
  let tasks = [];

  // Utilities
  const qs = id => document.getElementById(id);
  const save = () => localStorage.setItem(KEY, JSON.stringify(tasks));
  const load = () => JSON.parse(localStorage.getItem(KEY) || '[]');

  // Notifications
  if ('Notification' in window && Notification.permission === 'default') {
    Notification.requestPermission().catch(()=>{});
  }
  const scheduleReminder = (task) => {
    if (!('Notification' in window)) return;
    if (!task.reminder_time) return;
    const remindAt = new Date(task.reminder_time).getTime();
    const now = Date.now();
    const delay = remindAt - now;
    if (delay <= 0) return;
    // keep reference on task for clearing if needed
    task._reminderTimer = setTimeout(()=> {
      if (Notification.permission === 'granted') {
        new Notification('Study Reminder', {body: task.title});
      } else {
        alert('Reminder: ' + task.title);
      }
    }, delay);
  };

  // Render
  const render = () => {
    qs('tasksList').innerHTML = '';
    // sort by datetime asc
    tasks.sort((a,b)=> new Date(a.datetime) - new Date(b.datetime));
    tasks.forEach(t => {
      const el = document.createElement('div');
      el.className = 'task';
      const left = document.createElement('div');
      left.innerHTML = `<div style="font-weight:600">${t.title}</div>
        <div class="meta">${new Date(t.datetime).toLocaleString()} • ${t.duration_minutes||'-'} min • ${t.priority}</div>`;
      const right = document.createElement('div');
      right.className = 'actions';
      const chk = document.createElement('input');
      chk.type='checkbox'; chk.checked = !!t.done;
      chk.addEventListener('change',() => { t.done = chk.checked; save(); updateProgress(); render(); });
      const del = document.createElement('button'); del.textContent='Delete';
      del.addEventListener('click', ()=> { 
        if (t._reminderTimer) clearTimeout(t._reminderTimer);
        tasks = tasks.filter(x=>x.id !== t.id); save(); render(); 
      });
      right.appendChild(chk);
      const edit = document.createElement('button'); edit.textContent='Edit';
      edit.addEventListener('click', ()=> startEdit(t));
      right.appendChild(edit);
      right.appendChild(del);
      el.appendChild(left);
      el.appendChild(right);
      qs('tasksList').appendChild(el);
    });
    updateProgress();
  };

  const updateProgress = () => {
    const total = tasks.length || 0;
    const done = tasks.filter(t=>t.done).length;
    const p = total ? Math.round((done/total)*100) : 0;
    qs('stats').textContent = `${total} tasks • ${p}% done`;
    qs('progressBar').style.width = p + '%';
  };

  // Form handling
  const form = qs('taskForm');
  let editingId = null;
  form.addEventListener('submit', e => {
    e.preventDefault();
    const title = qs('title').value.trim();
    const datetime = qs('datetime').value;
    const duration = parseInt(qs('duration').value || '0',10);
    const priority = qs('priority').value;
    const reminderMin = parseInt(qs('reminder').value || '0',10);
    if (!title || !datetime) return alert('Enter title and date/time');

    const obj = {
      id: editingId || Date.now(),
      title,
      datetime: new Date(datetime).toISOString(),
      duration_minutes: duration,
      priority,
      reminder_minutes_before: reminderMin,
      done:false
    };

    // compute reminder_time if reminderMin > 0
    if (reminderMin > 0) {
      const dt = new Date(obj.datetime).getTime() - reminderMin*60*1000;
      obj.reminder_time = new Date(dt).toISOString();
    } else {
      delete obj.reminder_time;
    }

    if (editingId) {
      tasks = tasks.map(t => t.id === obj.id ? {...t, ...obj} : t);
      editingId = null;
    } else {
      tasks.push(obj);
    }
    save();
    // clear existing reminder timer for this task if any
    if (obj._reminderTimer) clearTimeout(obj._reminderTimer);
    // schedule notice if applicable
    scheduleReminder(obj);
    form.reset();
    render();
  });

  const startEdit = (t) => {
    editingId = t.id;
    qs('title').value = t.title;
    // set datetime-local input value
    const local = new Date(t.datetime);
    // format to yyyy-mm-ddThh:mm
    const pad = n=>String(n).padStart(2,'0');
    const dtLocal = `${local.getFullYear()}-${pad(local.getMonth()+1)}-${pad(local.getDate())}T${pad(local.getHours())}:${pad(local.getMinutes())}`;
    qs('datetime').value = dtLocal;
    qs('duration').value = t.duration_minutes || '';
    qs('priority').value = t.priority || 'medium';
    qs('reminder').value = t.reminder_minutes_before || '';
  };

  // Export / Import
  qs('exportBtn').addEventListener('click', () => {
    const blob = new Blob([JSON.stringify(tasks, null, 2)], {type:'application/json'});
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a'); a.href = url; a.download = 'study_tasks.json'; a.click();
    URL.revokeObjectURL(url);
  });
  qs('importBtn').addEventListener('click', ()=> qs('importFile').click());
  qs('importFile').addEventListener('change', (evt) => {
    const f = evt.target.files[0]; if(!f) return;
    const reader = new FileReader();
    reader.onload = () => {
      try {
        const imported = JSON.parse(reader.result);
        if (!Array.isArray(imported)) throw new Error('Invalid file');
        tasks = [...tasks, ...imported];
        save(); render();
        alert('Imported ' + imported.length + ' tasks');
      } catch(err) { alert('Import error: ' + err.message); }
    };
    reader.readAsText(f);
  });

  // Init
  const init = () => {
    tasks = load();
    // schedule reminders for tasks that have reminder_time in future
    tasks.forEach(t => {
      if (t._reminderTimer) clearTimeout(t._reminderTimer);
      if (t.reminder_time && !t.done) scheduleReminder(t);
    });
    render();
  };

  init();
})();